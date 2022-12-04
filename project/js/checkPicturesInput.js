var VALID_FILE_EXTENSIONS = [".jpg", ".jpeg", ".png", ".gif"];
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < VALID_FILE_EXTENSIONS.length; j++) {
                var sCurExtension = VALID_FILE_EXTENSIONS[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("File " + sFileName + " không hợp lý, vui lòng upload file có đuôi là " + VALID_FILE_EXTENSIONS.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}