/* SCRIPTS FOR CUSTODIAN SIDE */
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        });
        li.classList.add('active');
    })
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu-alt-left');
const sideBar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sideBar.classList.toggle('hide');
})

// ROOM STATUS
document.addEventListener("DOMContentLoaded", function () {
    function updateColor(element) {
        if (element.textContent.trim() === "Available") {
            element.style.backgroundColor = "var(--approve)";
            element.style.color = "var(--primary)";
        } else if (element.textContent.trim() === "Unavailable") {
            element.style.backgroundColor = "var(--error)";
            element.style.color = "var(--primary)";
        }
        element.style.textAlign = "center";
        element.style.marginLeft = "55px";
        element.style.borderRadius = "15px";
        element.style.height = "30px";
        element.style.lineHeight = "30px";
    }

    // Initial update for existing elements
    var roomStatusElements = document.querySelectorAll("#room-status");
    roomStatusElements.forEach(function (element) {
        updateColor(element);
    });

    // Listen for changes in the subtree of the document
    document.body.addEventListener("DOMSubtreeModified", function (event) {
        if (event.target.matches("#room-status")) {
            updateColor(event.target);
        }
    });

});

// LOGOUT MODAL UI
function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'block';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}

function logout() {
    window.location.href = "custodian_logout.php";
}
