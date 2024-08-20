 

<!DOCTYPE html>
<html lang="en">
<head>
 

    <style>
     .file-input-container {
    position: relative;
    display: inline-block;
}

.file-input {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0; /* Hide the default file input */
    cursor: pointer;
}

.file-label {
    display: inline-block;
    padding: 10px 20px;
    background-color: rgb(9, 37, 82); /* Blue color */
    color: white;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    font-size: 16px;
}

.file-label:hover {
    background-color: rgb(7, 29, 60); /* Darker blue on hover */
}

    </style>
</head>

<body>
   
<div class="form-group">
    <label for="siteImage">Photo of the site:</label>
    <div class="file-input-container">
        <input type="file" id="siteImage" name="image" class="file-input" required>
        <label for="siteImage" class="file-label">Choose File</label>
    </div>
</div>

</body>
</html>
