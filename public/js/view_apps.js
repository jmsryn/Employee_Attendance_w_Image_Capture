let editApp = document.getElementById('editApp')
const saveApp = document.getElementById('saveApp')


//leave_form
const leave_type = document.getElementById('leave_type')
const type_leave = document.getElementById('type_leave')
const date_from = document.getElementById('date_from')
const date_to = document.getElementById('date_to')
const reason = document.getElementById('reason')

//under form or over form
const date = document.getElementById('date_req')
const hours = document.getElementById('hours')
const reasonUnder_Over = document.getElementById('reason')

//timesheet form 
const time_hide = document.getElementById('time_hide')
const time_show = document.getElementById('time_show')
const date_ts = document.getElementById('date_ts')

//profile
const contact = document.getElementById('contact')
const addr = document.getElementById('addr')
const email = document.getElementById('email')
const dept_d = document.getElementById('dept_d')
const dept_a = document.getElementById('dept_a')
const user_type_d = document.getElementById('user_type_d')
const user_type_a = document.getElementById('user_type_a')

editApp.addEventListener('click', function(){
    var x = editApp.getAttribute('name')
    if(x == 'leave'){
        editApp.classList.add('hide')
        saveApp.classList.remove('hide')
        type_leave.classList.remove('hide')
        leave_type.classList.add('hide')
        leave_type.removeAttribute('readonly'), date_from.removeAttribute('readonly'), date_to.removeAttribute('readonly'), reason.removeAttribute('readonly')
    } else if (x == 'under'){
        editApp.classList.add('hide')
        saveApp.classList.remove('hide')
        date.removeAttribute('readonly')
        hours.removeAttribute('readonly')
        reasonUnder_Over.removeAttribute('readonly')
    } else if (x == 'over'){
        editApp.classList.add('hide')
        saveApp.classList.remove('hide')
        date.removeAttribute('readonly')
        hours.removeAttribute('readonly')
        reasonUnder_Over.removeAttribute('readonly')
    } else if (x == 'timesheet') {
        editApp.classList.add('hide')
        saveApp.classList.remove('hide')
        date_ts.removeAttribute('readonly')
        time_hide.classList.add('hide')
        time_show.classList.remove('hide')
    } else if (x == 'profile') {
        editApp.classList.add('hide')
        saveApp.classList.remove('hide')
        contact.removeAttribute('readonly')
        addr.removeAttribute('readonly')
        email.removeAttribute('readonly')
        dept_d.classList.add('hide')
        dept_a.classList.remove('hide')
        user_type_d.classList.add('hide')
        user_type_a.classList.remove('hide')
    }
})