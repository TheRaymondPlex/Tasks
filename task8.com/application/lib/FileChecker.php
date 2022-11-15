<?php

namespace application\lib;

use PNGMetadata\PNGMetadata;

class FileChecker
{
    private const MAX_SIZE = 1000000; // Max size for single file upload
    public const UPLOADS_FOLDER_PATH = 'uploads/'; // Default folder for uploads
    private static array $composedImageMeta = [];

    private static array $allowedImageTypes = [ // Allowed image types that can be uploaded
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];
    private static array $allowedTextTypes = [ // Allowed text types that can be uploaded
        'txt' => 'text/plain',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    private static function isImageType(string $fileType): bool
    {
        if (in_array($fileType, self::$allowedImageTypes)) {
            return true;
        }

        return false;
    }

    private static function isTextType(string $fileType): bool
    {
        if (in_array($fileType, self::$allowedTextTypes)) {
            return true;
        }

        return false;
    }

    private static function composingMetaArray($arr): array
    {
        self::$composedImageMeta = [];
        foreach ($arr as $key => $item) {
            if (is_array($item)) {
                self::$composedImageMeta = array_merge(self::$composedImageMeta, self::composingMetaArray($item));
            } else {
                self::$composedImageMeta[$key] = $item;
            }
        }

        return self::$composedImageMeta;
    }

    private static function getImageMetaDataInArray(string $upload): array
    {
        if (PNGMetadata::isPNG($upload)) {
            $metas = PNGMetadata::extract($upload)->toArray();
        } else {
            $metas = exif_read_data($upload);
        }

        return self::composingMetaArray($metas);
    }

    public static function deleteDots(string $folderPath): array
    {
        $filesWithoutDots = array_diff(scandir($folderPath), array('..', '.'));

        return array_values($filesWithoutDots);
    }

    public static function validatingFilesOnUpload(): string
    {
        $errors = '';
        $fileSize = $_FILES['filename']['size'];
        $fileType = $_FILES['filename']['type'];
        $serverFreeSpace = disk_free_space(self::UPLOADS_FOLDER_PATH);
        $errorCounter = 0;

        if ($fileSize > self::MAX_SIZE) {
            $errorCounter++;
            $errors .= $errorCounter . ") Size is too big!\n";
        }

        if (!self::isImageType($fileType) && !self::isTextType($fileType)) {
            $errorCounter++;
            $errors .= $errorCounter . ") Incorrect file type!\n";
        }

        if ($fileSize >= $serverFreeSpace) {
            $errorCounter++;
            $errors .= $errorCounter . ") There is no free space on server!\n";
        }

        return $errors;
    }

    public static function getMetaData(array $uploads): array
    {
        $filesData = [];

        foreach ($uploads as $upload) {
            $fileName = str_replace(self::UPLOADS_FOLDER_PATH, '', $upload);
            $fileSize = round(filesize($upload) / 1024, 2);

            if (self::isImageType(mime_content_type($upload))) {
                $singleFileData['name'] = $fileName;
                $singleFileData['size'] = $fileSize;
                $singleFileData['meta'] = self::getImageMetaDataInArray($upload);

                $filesData[] = $singleFileData;
            }
            if (self::isTextType(mime_content_type($upload))) {
                $singleFileData['name'] = $fileName;
                $singleFileData['size'] = $fileSize;
                $singleFileData['meta'] = 'This is a text file. Metadata shows for images only!';

                $filesData[] = $singleFileData;
            }
        }

        return $filesData;
    }
}