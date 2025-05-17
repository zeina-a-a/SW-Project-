<?php
class AddMedia {
    public static function upload($fileInputName, $destinationFolder = "../../Views/uploads/") {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {
            if (!file_exists($destinationFolder)) {
                mkdir($destinationFolder, 0755, true);
            }

            $uniqueName = date("H-i-s") . "_" . basename($_FILES[$fileInputName]["name"]);
            $location = $destinationFolder . $uniqueName;

            if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $location)) {
                return $location;
            } else {
                return false;
            }
        }
        return null; // if no file uploaded
    }
}
?>