const toggleButton = document.getElementsByClassName('toggle-button')[0];
const navbarLinks = document.getElementsByClassName('navbar')[0];





toggleButton.addEventListener('click', ()=>{
    navbarLinks.classList.toggle('active');
    
})



document.addEventListener('click', e => {
    const isDropdownButton = e.target.matches("[data-dropdown-button]")
    if(!isDropdownButton && e.target.closest('[data-dropdown]') != null) return

    let currentDropdown;

    if (isDropdownButton){
        currentDropdown = e.target.closest('[data-dropdown]');
        currentDropdown.classList.toggle('active');
    }

    document.querySelectorAll('[data-dropdown].active').forEach(dropdown =>{
        if(dropdown === currentDropdown) return;
        dropdown.classList.remove('active');
    })
})

//email cell toggle
function emailDis(x){
    if(x==0){
        document.getElementById('email').style.display = 'block';
        document.getElementById('emailIn').innerHTML = "<input type='email' name='email' id='emailIn' />";
    } else {
        document.getElementById('email').style.display = 'none';
    }

}

