$(document).ready(function () {
    $('#exitNav').on('click', () => {
        $.ajax({
            url: 'php/actions/logout.php',
            method: 'POST',
            success: function (datas) {
                location.reload();
            }
        });
    });

    $('#showNav').on('click', () => {
        show();
    });

    $('#showMessage').on('click',()=> {
        const cont = document.querySelector('.container');
        $.ajax({
            url: 'php/actions/getMessage.php',
            method: 'GET',
            success: function (datas) {
               cont.innerHTML = datas;
            }
        });
    });

    function show(){
        const btn = document.querySelector('#showNav');
        const cont = document.querySelector('.container');
        $.ajax({
            url: 'php/actions/showUsers.php',
            method: 'GET',
            success: function (datas) {
                cont.innerHTML = datas;
                if (document.querySelectorAll('tbody tr').length<1) {
                    $.ajax({
                        url: 'php/actions/logout.php',
                        method: 'POST',
                        success: function (datas) {
                            location.reload();
                        }
                    });
                }


                sendMessage();
                function sendMessage() {
                    const btnSend = $('tbody button');
                    
                    btnSend.click(function(){
                        const uid = $(this).attr('data-uid');
                        const login = $(this).attr('data-login');
                        const msg = $('#textMessage').val();
                       
                        if (msg.length > 0) {
                            $.ajax({
                                url: 'php/actions/sendMessage.php',
                                method: 'POST',
                                data:{login: login, uid: uid, msg: msg},
                                success: function (datas) {
                                    show();
                                   
                                }
                            });  
                        }
                    })
                };
                changeRole();
                function changeRole(){
                    const role = $('.dropdown-menu a');
                    const checkUser = $('tbody [type="checkbox"]');
                    role.click(function(){
                        let id = $(this).attr('data-id');
                        checkUser.each(function () {
                            if (this.checked) {
                                $.ajax({
                                    url: 'php/actions/changeRole.php',
                                    method: 'POST',
                                    data:{role: id, uid: $(this).attr("data-uid")},
                                    success: function (datas) {
                                        show();
                                       
                                    }
                                });  
                            }
                        })
                    })
                }

                delUser();
                function delUser(){
                    const uid = $('#exitNav').attr("data-uid");
                    const checkUser = $('tbody [type="checkbox"]');
                    let count = 0;
                    checkUser.each(function () {
                        if (uid==$(this).attr("data-uid")){
                            count++
                        }
                    })
                    if (count <1) {
                        $.ajax({
                            url: 'php/actions/logout.php',
                            method: 'POST',
                            success: function (datas) {
                                location.reload();
                            }
                        });
                    }
                }
                checkedAll();
                logoff();
                function logoff() {
                    const checkUser = $('tbody [type="checkbox"]');
                    const uid = $('#exitNav').attr("data-uid");
                    checkUser.each(function () {
                            
                        if ($(this).attr("data-uid") == uid && $(this).attr("data-status")==2 || document.querySelectorAll('tbody tr').length<1) {
                            $.ajax({
                                url: 'php/actions/logout.php',
                                method: 'POST',
                                success: function (datas) {
                                    location.reload();
                                }
                            });
                        }
                    });
                }
                function checkedAll() {
                    const checkbox = $('#checkAll [type="checkbox"]');
                    const checkAll = $('tbody .form-check-input');

                    checkbox.change(function () {
                        if (this.checked) {
                            checkAll.each(function () {
                                this.checked = true;
                            });
                        } else {
                            checkAll.each(function () {
                                this.checked = false;
                            });
                        }
                    });
                }
                blockUser();
                function blockUser(){
                    const blockBtn = $('#blockBtn');
                    const checkUser = $('tbody [type="checkbox"]');
                    blockBtn.click(function(){
                        checkUser.each(function () {
                            if (this.checked) {    
                                $.ajax({
                                    url: 'php/actions/blockUser.php',
                                    method: 'POST',
                                    data:{uid: $(this).attr("data-uid")},
                                    success: function (datas) {
                                        show();
                                       
                                    }
                                });   
                            }          
                        }); 
                    })
                }
                unblockUser();
                function unblockUser(){
                    const unblockBtn = $('#unblovkBtn');
                    const checkUser = $('tbody [type="checkbox"]');
                    unblockBtn.click(function(){
                        checkUser.each(function () {
                            if (this.checked) {
                                
                                $.ajax({
                                    url: 'php/actions/unblockUser.php',
                                    method: 'POST',
                                    data:{uid: $(this).attr("data-uid")},
                                    success: function (datas) {
                                        show();
                                    }
                                }); 
                            }
                        });
                    })
                }
                deleteUser();
                function deleteUser(){
                    const blockBtn = $('#deleteBtn');
                    const checkUser = $('tbody [type="checkbox"]');
                    blockBtn.click(function(){
                        checkUser.each(function () {
                            if (this.checked) {   
                                $.ajax({
                                    url: 'php/actions/deleteUser.php',
                                    method: 'POST',
                                    data:{uid: $(this).attr("data-uid")},
                                    success: function (datas) {
                                        show();
                                    }
                                });   
                            } 
                        });
                    })
                };
            }
        });
    }
});

window.addEventListener("DOMContentLoaded", () => {
    navSelect();
    openSelectNav('#signNav', '.container', 'php/forms/signPage.php');
    openSelectNav('#regNav', '.container', 'php/forms/registrationPage.php');
    check();
    showUsers();

    function check() {
        const el = document.querySelector('.navbar-nav a');
        if (el.id == "signNav") el.click();
    }

    function navSelect() {
        const navItem = document.querySelectorAll('.navbar-nav a');

        navItem.forEach(Items => {
            Items.addEventListener('click', (e) => {
                navItem.forEach(item => {
                   item.classList.remove('active');    
                });
                    e.target.classList.add('active');
            });
        });
    }

    function openSelectNav(navBtn, container, url) {
        let btnNav = document.querySelector(navBtn);

        btnNav.addEventListener('click', () => {
            const cont = document.querySelector(container);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (datas) {
                    cont.innerHTML = datas;
                    const formID = document.querySelector('#form');

                    if (formID.classList.contains('regForm')) {
                        reg();
                    }
                    if (formID.classList.contains('signForm')) {
                        sign();
                    }
                }
            });
        });
    }

    function sign() {
        const btn = document.querySelector('.signForm button');
        const login = document.querySelector('#InputLogin');
        const password = document.querySelector('#InputPassword');
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            $.ajax({
                url: 'php/actions/enter.php',
                method: 'POST',
                data: {
                    enter: 'enter',
                    login: `${login.value}`,
                    password: `${password.value}`
                },
                success: function (datas) {
                    location.reload();
                }
            });
        })
    }

    function reg() {
        const btn = document.querySelector('.regForm button');
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const login = document.querySelector('#InputLogin');
            const password = document.querySelector('#InputPassword');
            const secpassword = document.querySelector('#InputPasswordAgain');
            const email = document.querySelector('#exampleInputEmail1');
            const modal = document.querySelector('#exampleModal');
            const bd = document.querySelector('body');

            const text = document.querySelector('.modal-body');
            text.textContent = 'Incorrect data or passwords do not match';
                if (password.value!=secpassword.value) {
                    $('#exampleModal').modal('show');
                }
                else {
                    $.ajax({
                        url: 'php/actions/registration.php',
                        method: 'POST',
                        data: {
                            submit: 'submit',
                            login: `${login.value}`,
                            password: `${password.value}`,
                            email: `${email.value}`
                        },
                        success: function (datas) {
                            location.reload();
                        }
                    });
                }
        })
    }
})