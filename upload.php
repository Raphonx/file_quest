<?php

$files = new FilesystemIterator('uploads/');
$errors = [];
$directory = 'uploads/';
$extensions = ['jpg', 'png', 'gif'];

if (!empty($_FILES)) {
    foreach ($_FILES['upload']['name'] as $key => $value) {
        $fileType = pathinfo($value, PATHINFO_EXTENSION);
        if (!in_array($fileType, $extensions)) {
            $errors['error'] = 'Veuillez choisir le bon format de fichier';
            } elseif ($_FILES['upload']['error'][$key] == 2) {
            $errors['error'] = 'Votre fichier ne doit pas depasser 1MO ';
        }
    }
        if (empty($errors)){
            $uploadFile = $directory . uniqid() . '.' . $fileType;
            move_uploaded_file($_FILES['upload']['tmp_name'][$key], $uploadFile);
            //redirection
            header('Location : upload.php');
        }

}
    ?>


    <form action="" method="post" enctype="multipart/form-data">
        <label for="uploads">Upload Files</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="file" id="uploads" name="upload[]" multiple="multiple"/>
        <button type="submit">Upload</button>
    </form>
    <p><?php echo isset($errors['error']) ? $errors['error'] : '' ?></p>

<?php foreach ($files as $file) : ?>
    <p><?= $file ?></p>
<?php endforeach; ?>
