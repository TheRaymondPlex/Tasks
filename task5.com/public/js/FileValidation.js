const MAX_SIZE = 1000000; // max size in bytes (1000000 bytes = 1MB)

function FileValidation() {
    let formFile = document.getElementById('formFile');
    let filePath = formFile.value;
    const allowedImageTypes = /(\.jpg|\.png|\.gif)$/i;
    const allowedTextTypes = /(\.txt|\.doc|\.docx)$/i;
    // Check if any file is selected.
    if (formFile.files.length > 0) {
        for (let i = 0; i <= formFile.files.length - 1; i++) {
            const fsize = formFile.files.item(i).size;
            // The size of the file.
            if (fsize >= MAX_SIZE) {
                alert('File size is too big! In must me less than ' + Math.round(MAX_SIZE/1024/1024) + ' MB');
                formFile.value = ''; // removing file from form
            } else {
                if (allowedImageTypes.exec(filePath)) {
                    showPreview(event);
                    document.getElementById('size').innerHTML = '<b>File size: ' + fsize + '</b> bytes';
                    return;
                } else if (!allowedTextTypes.exec(filePath) && !allowedImageTypes.exec(filePath)) {
                    alert('Invalid file type!');
                    formFile.value = '';
                    return;
                } else {
                    document.getElementById('size').innerHTML = '<b>File size: ' + fsize + '</b> bytes';
                }
            }
        }
    }
}

function showPreview(event){
    if(event.target.files.length > 0){
        let src = URL.createObjectURL(event.target.files[0]);
        let preview = document.getElementById("file-ip-1-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}