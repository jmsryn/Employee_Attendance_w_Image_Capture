const dropdown = document.getElementById('dropdowntoggle')
const drop = document.getElementById('dropClass')

const timebtn = document.getElementById('timebtn')
const profilebtn = document.getElementById('profileBtn')
const appBtn = document.getElementById('appBtn')

const profileNavTop = document.getElementById('profileNavTop')

const empTime = document.getElementById('empTime')
const empList = document.getElementById('empList')
const empProfile = document.getElementById('empProfile')
const empApp = document.getElementById('empApp')

const backbtnProfile = document.getElementById('backbtnProfile')

const closeNotif = document.getElementById('closeNotif')
const notif = document.getElementById('notif')

closeNotif.addEventListener('click', function(){
    notif.classList.add('hide')
})

timebtn.addEventListener('click', function(){
    empList.classList.add('hide')
    empProfile.classList.add('hide')
    empApp.classList.add('hide')
    profileNavTop.classList.remove('hide')
    empTime.classList.remove('hide')
})

profilebtn.addEventListener('click', function(){
    profileNavTop.classList.remove('hide')
    empList.classList.add('hide')
    empTime.classList.add('hide')
    empApp.classList.add('hide')
    empProfile.classList.remove('hide')
})


appBtn.addEventListener('click', function(){
    empList.classList.add('hide')
    empTime.classList.add('hide')
    empProfile.classList.add('hide')
    empApp.classList.remove('hide')
    profileNavTop.classList.remove('hide')
})

backbtnProfile.addEventListener('click', function(){
    empTime.classList.add('hide')
    empProfile.classList.add('hide')
    profileNavTop.classList.add('hide')
    empList.classList.remove('hide')
    empApp.classList.add('hide')
})

dropdown.addEventListener('click', function(){
    if(drop.classList.contains('hide')){
        drop.classList.remove('hide')
    } else {
        drop.classList.add('hide')
    }
})