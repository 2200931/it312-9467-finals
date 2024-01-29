/* SCRIPTS FOR USER SIDE */
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

// EQUIPMENT STATUS
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
        element.style.borderRadius = "0 0 10px 10px";
        element.style.height = "30px";
        element.style.lineHeight = "30px";
    }

    // Initial update for existing elements
    var roomStatusElements = document.querySelectorAll("#equip-status");
    roomStatusElements.forEach(function (element) {
        updateColor(element);
    });

    // Listen for changes in the subtree of the document
    document.body.addEventListener("DOMSubtreeModified", function (event) {
        if (event.target.matches("#equip-status")) {
            updateColor(event.target);
        }
    });

});

// DATE FORMAT
document.addEventListener("DOMContentLoaded", function () {
    function formatDate(dateString) {
        const date = new Date(dateString);
        const year = date.getFullYear();
        const monthNames = ["Jan", "Feb", "Mar", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
        const month = monthNames[date.getMonth()];
        const day = String(date.getDate()).padStart(2, '0');
        let hours = date.getHours();
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        const amOrPm = hours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        hours = hours % 12 || 12;

        return `${month} ${day} ${year} ${hours}:${minutes}:${seconds} ${amOrPm}`;
    }

    const createdAtElements = document.querySelectorAll('[data-date-format="created_at"]');
    const updatedAtElements = document.querySelectorAll('[data-date-format="updated_at"]');
    const transactAtElements = document.querySelectorAll('[data-date-format="transaction_date"]');

    createdAtElements.forEach(element => {
        element.textContent = `Created: ${formatDate(element.textContent.trim())}`;
    });

    updatedAtElements.forEach(element => {
        element.textContent = `Updated: ${formatDate(element.textContent.trim())}`;
    });
    transactAtElements.forEach(element => {
        element.textContent = `${formatDate(element.textContent.trim())}`;
    });
});

// MODAL UI
var rmModal = document.getElementById("viewModal");
var rtModal = document.getElementById("rentModal");
var lgModal = document.getElementById("logoutModal");

window.onclick = function (event) {
    if (event.target == lgModal) {
        lgModal.style.display = "none";
    } else if (event.target == rmModal) {
        rmModal.style.display = "none"; 
    } else if (event.target == rtModal) {
        rtModal.style.display = "none";
    }
};

// ROOM VIEW MODAL UI
function openViewModal() {
    document.getElementById('viewModal').style.display = 'block';
}

function closeViewModal() {
    document.getElementById('viewModal').style.display = 'none';
}

// RENT MODAL UI
function openRentModal() {
    document.getElementById('rentModal').style.display = 'block';
}

function closeRentModal() {
    document.getElementById('rentModal').style.display = 'none';
}

// LOGOUT MODAL UI
function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'block';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}

function logout() {
    window.location.href = "/auth/logout";
}


