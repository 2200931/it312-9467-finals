/* SCRIPTS FOR CUSTODIAN SIDE */
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=>{
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
