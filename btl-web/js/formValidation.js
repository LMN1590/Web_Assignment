function validate() {
  let get = (id) => {
    return document.getElementById(id);
  };

  let username = get("username"),
    //password = get("password"),
    fullname = get("fullname"),
    email = get("email"),
    phone = get("phone"),
    //address = get("address"),
    errorMsg = document.getElementsByClassName("error"); // num = 6
  var out = true;

  if (
    !username.value.match(
      "/^[0-9a-zA-Z-'.,()*!áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/"
    )
  ) {
    errorMsg[0].innerHTML =
      "Valid input only include 0-9a-zA-Z-'.,()*! and space";
    out = false;
  }

  if (
    !fullname.value.match(
      "/^[a-zA-Z-'áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/"
    )
  ) {
    errorMsg[2].innerHTML = "Valid input only include a-zA-Z-' and space";
    out = false;
  }

  if (
    !email.value.match(
      "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/"
    )
  ) {
    errorMsg[3].innerHTML = "Invalid email";
    out = false;
  }

  if (!phone.value.match("/^[0-9+()]*$/")) {
    errorMsg[4].innerHTML = "Invalid phone number";
    out = false;
  }

  return out;
}
