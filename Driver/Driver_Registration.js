// Flip card animation handlers
const flipper = document.getElementById('cardFlipper');
const showLogin = document.getElementById('showLogin');
const showRegister = document.getElementById('showRegister');

showLogin.addEventListener('click', () => {
    flipper.classList.add('flipped');
    document.getElementById('loginUsername').focus();
});

showRegister.addEventListener('click', () => {
    flipper.classList.remove('flipped');
});

// =========================
// DRIVER REGISTRATION
// =========================
document.getElementById('registrationForm')
    .addEventListener('submit', async function (e) {
        e.preventDefault();

        const message = document.getElementById('registerMessage');
        const formData = new FormData(this);

        // Check empty fields
        for (let pair of formData.entries()) {
            if (pair[1].trim() === "") {
                message.innerText = "All fields need to be filled.";
                message.style.color = "#cc3333";
                return;
            }
        }

        try {
            const response = await fetch('register_driver.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {
                message.innerText = data.message;
                message.style.color = "#2d9c5a";

                // Optional flip after success
                setTimeout(() => {
                    flipper.classList.add('flipped');
                }, 1200);

                this.reset();
            } else {
                message.innerText = data.message;
                message.style.color = "#cc3333";
            }
        } catch (err) {
            message.innerText = "Server error occurred.";
            message.style.color = "#cc3333";
        }
    });

// =========================
// DRIVER LOGIN
// =========================
document.getElementById('loginForm')
    .addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch('login_driver.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {
                window.location.href = "Dashboard.php";
            } else {
                alert(data.message);
            }
        } catch (err) {
            alert("Server error occurred.");
        }
    });