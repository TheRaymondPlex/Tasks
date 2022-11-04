<?php

namespace application\lib;

class FormChecker
{
    private const MIN_PASS_LENGTH = 6;
    private const MAX_PASS_LENGTH = 15;

    public static array $errors = [];

    private static function modifyFormData(string $data): string
    {
        $data = trim($data);

        return htmlspecialchars($data);
    }

    private static function validateName(string $name): void
    {
        $name = self::modifyFormData($name);
        $pattern = "#^[a-zA-Z-' ]*$#";

        if (empty($name)) {
            self::$errors[] = 'Name field is empty!';
        } elseif (!preg_match($pattern, $name)) {
            self::$errors[] = 'Only letters and white space can be in Name field!';
        } elseif (strlen($name) < 3) {
            self::$errors[] = 'Name is too short! At least 3 characters needed.';
        }
    }

    private static function validateEmail(string $email): void
    {
        $email = self::modifyFormData($email);

        if (empty($email)) {
            self::$errors[] = 'Email field is empty!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$errors[] = 'This Email is not allowed!';
        }
    }

    private static function validatePassword(string $password): void
    {
        $password = self::modifyFormData($password);
        $pattern = "/^(?=.*[0-9])(?=.*[.!@#$%^&*])(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9.!@#$%^&*]{" . self::MIN_PASS_LENGTH . "," . (self::MAX_PASS_LENGTH + 1) . "}$/";

        if (empty($password)) {
            self::$errors[] = 'Password field is empty!';
        } elseif (!preg_match($pattern, $password)) {
            self::$errors[] = 'Your password is declined! Try another one.';
        }
    }

    public static function checkErrorsInForm(): array
    {
        if (isset($_POST)) {
            self::validateName($_POST['first-name']);
            self::validateName($_POST['second-name']);
            self::validateEmail($_POST['email']);
            self::validatePassword($_POST['pass']);
        } else {
            self::$errors[] = 'Something went wrong with sending form data!';
        }

        return self::$errors;
    }
}