function FileValidation() {
    let fi = document.getElementById('formFile');
    let filePath = fi.value;
    const allowedImages = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    const allowedTexts = /(\.txt|\.docx|\.doc)$/i;
    // Check if any file is selected.
    if (fi.files.length > 0) {
        for (let i = 0; i <= fi.files.length - 1; i++) {
            const fsize = fi.files.item(i).size;
            const file = Math.round((fsize / 1024));
            // The size of the file.
            if (file >= 1024) {
                alert('File size is too big! In must me less than 1 MB');
                fi.value = '';
            } else {
                if (allowedImages.exec(filePath)) {
                    showPreview(event);
                    document.getElementById('size').innerHTML = '<b>File size: ' + file + '</b> KB';
                    return;
                } else if (!allowedTexts.exec(filePath) && !allowedImages.exec(filePath)) {
                    alert('Invalid file type!');
                    fi.value = '';
                    return;
                } else {
                    document.getElementById('size').innerHTML = '<b>File size: ' + file + '</b> KB';
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