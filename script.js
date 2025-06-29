// Login
const loginForm = document.querySelector("#login-form");
if(loginForm) {
    loginForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const email = event.target.email.value;
        const password = event.target.password.value;

        if(email && password) {
            alert("Đăng nhập thành công");
            window.location.href = "index.html";
        } else {
            alert("Bạn chưa nhập tài khoản hoặc mật khẩu");
        }
    });
}

//Register
const registerForm = document.querySelector("#register-form");
if(registerForm) {
    registerForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const fullName = event.target.fullName.value;
        const email = event.target.email.value;
        const phoneNumber = event.target.sdt.value
        const password = event.target.password.value;
        
        if(fullName && email && phoneNumber && password) {
            alert("Bạn đã đăng ký tài khoản thành công");
            window.location.href = "login.html";
        } else {
            alert("Bạn chưa nhập đầy đủ các thông tin cần thiết");
        }
    })
}

//pagination
const paginationAll = document.querySelectorAll(".pagination-all")
if(paginationAll){
    paginationAll.forEach((item) => {
        item.addEventListener("click", () => {
            const itemPagi = document.querySelector(".pagination-bg");
            if(itemPagi) {
                itemPagi.classList.remove("pagination-bg")
            }
            item.classList.add("pagination-bg")
        })
    })
}

//discount code
const discountCode = document.querySelector(".discount-code");
if(discountCode) {
    const discount = discountCode.querySelectorAll(".discount");
    discount.forEach(item => {
        item.addEventListener("click", () => {
            const colorBg = document.querySelector(".color-bg");
            if(colorBg) {
                colorBg.classList.remove("color-bg");
            }
            item.classList.add("color-bg");
        })
    })
}

//color size
const innerSize = document.querySelector(".inner-size");
if(innerSize) {
    const size = innerSize.querySelectorAll(".size");
    size.forEach(item => {
        item.addEventListener("click", () => {
            const colorBg = document.querySelector(".color-size");
            if(colorBg) {
                colorBg.classList.remove("color-size");
            }
            item.classList.add("color-size");
        })
    })
}

const urlParams = new URLSearchParams(window.location.search);
const statusParam = urlParams.get('status');
console.log(statusParam);


//edit profile
const nameUser = document.querySelector("#nameUser");
if(nameUser) {
    const nameLogin = document.querySelector(".name-login");
    nameUser.addEventListener("click", () => {
        nameLogin.classList.toggle("show-user");
    })
}

const phoneUser = document.querySelector("#phoneUser");
if(phoneUser) {
    const phoneLogin = document.querySelector(".phone-login");
    phoneUser.addEventListener("click", () => {
        console.log('aa')
        phoneLogin.classList.toggle("show-user");
    })
}

const passwordUser = document.querySelector("#passwordUser");
if(passwordUser) {
    const passwordLogin = document.querySelector(".password-login");
    const passwordAgain = document.querySelector(".password-again");
    passwordUser.addEventListener("click", () => {
        passwordLogin.classList.toggle("show-user");
        passwordAgain.classList.toggle("show-user");
    })
}

const addressUser = document.querySelector("#addressUser");
if(addressUser) {
    const addressLogin = document.querySelector(".address-login");
    addressUser.addEventListener("click", () => {
        addressLogin.classList.toggle("show-user");
    })
}


// Debug tim kiếm
// console.log("Script loaded");

// document.addEventListener("DOMContentLoaded", function () {
//     const searchInput = document.getElementById("searchInput");
//     console.log("Search Input:", searchInput);
// });

// Xử ký đề cử khi nhập tìm kiếm
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const suggestionsBox = document.getElementById("suggestions");

    searchInput.addEventListener("input", function () {
        const query = this.value;

        if (query.length === 0) {
            suggestionsBox.innerHTML = "";
            return;
        }

        fetch(`search-suggest.php?query=${encodeURIComponent(query)}`)
            .then(res => res.text()) // đọc thô trước
            .then(data => {
                console.log("RAW response:", data); // để kiểm tra kết quả trả về

                try {
                    const json = JSON.parse(data); // thử chuyển thành JSON
                    let html = "";

                    if (json.length > 0) {
                        json.forEach((item) => {
                            html += `<div class="suggestion-item">${item}</div>`;
                        });
                    } else {
                        html = `<div class="suggestion-item">Không tìm thấy</div>`;
                    }

                    suggestionsBox.innerHTML = html;

                    document.querySelectorAll(".suggestion-item").forEach(item => {
                        item.addEventListener("click", () => {
                            searchInput.value = item.textContent;
                            suggestionsBox.innerHTML = "";

                            // Tự động submit form
                            searchInput.form.submit();
                        });

                    });
                } catch (e) {
                    console.error("Lỗi chuyển JSON:", e);
                    suggestionsBox.innerHTML = "<div class='suggestion-item'>Lỗi dữ liệu</div>";
                }
            })
            .catch(err => {
                console.error("Lỗi fetch:", err);
                suggestionsBox.innerHTML = "<div class='suggestion-item'>Không thể tải gợi ý</div>";
            });
    });
});


