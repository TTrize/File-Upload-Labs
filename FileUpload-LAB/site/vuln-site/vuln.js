function submitPost() {
     // Send backend request to with AJAX
    const formData = new FormData();
    const title = document.querySelector('input[placeholder="Title"]').value;
    const content = document.querySelector('textarea[placeholder="Content"]').value;
    const fileInput = document.getElementById('fileInput').files[0];
    formData.append('title', title);
    formData.append('content', content);
    formData.append('file', fileInput);
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'vulnupload.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Response to sucessfull
            alert("Upload successful! /uploadvuln/");
        } else if (xhr.status === 500) {
            //Invalid format
            alert("Error: invalid extension format.");
        } else {
            // if request 400
            alert("Error uploading file.");
        }
    };
    xhr.send(formData);
}

const fileInput = document.getElementById('fileInput');
const fileInputLabel = document.getElementById('fileInputLabel');

fileInput.addEventListener('change', handleFileSelect);

fileInputLabel.addEventListener('dragover', (e) => {
    e.preventDefault();
    fileInputLabel.classList.add('dragover');
});

fileInputLabel.addEventListener('dragleave', () => {
    fileInputLabel.classList.remove('dragover');
});

fileInputLabel.addEventListener('drop', (e) => {
    e.preventDefault();
    fileInputLabel.classList.remove('dragover');
    fileInput.files = e.dataTransfer.files;
    handleFileSelect();
});

function handleFileSelect() {
    const files = fileInput.files;
    if (files.length > 0) {
        const fileName = files[0].name;
        fileInputLabel.innerText = fileName;
    }
}
