// Подключение разных кнопок, блоков
const body = document.querySelector('body');
const catalogmenu = document.querySelector('.catalog-menu');
const stat = document.querySelector('.one-one');
const ruck = document.querySelector('.two-one');
const brel = document.querySelector('.tree-one');
const logo = document.querySelector('.logo-svg');
const sub = document.querySelector('.subscription');
const slid = document.querySelector('.slider');
const prise = document.querySelector('.block-prise');
const curt = document.querySelector('.curt');
const shop = document.querySelector('.shop');
const number = document.querySelectorAll('input[type=number]');
const order = document.querySelector('.order');
const menu = document.querySelector('.clear');
const listmenu = document.querySelector('.list-menu');
const popup = document.querySelectorAll('.popup');
const email = document.querySelector('.email');
const pback = document.querySelector('.popup-back');
const emailbtn = document.querySelector('.email-btn');
const register = document.querySelector('.Wreg');
const Register = document.querySelector('.register-form');
const url = document.querySelectorAll('.url-product');
const productcurt = document.querySelector('.product-curt');
const orderbtn = document.querySelector('.order-btn');
const Phead = document.querySelector('.product-head');
const pc = document.querySelector('.pc-text');
const Up = document.querySelector('.Up');
const Down = document.querySelector('.Down');
const Rand = document.querySelector('.Rand');
const sort = document.querySelectorAll('.grid-product a');  


// Функции
if (document.querySelector('.grid-product')) {
    const Sortblock = Array.from(sort);
    for (let index = 0; index < 1; index++) {
        document.querySelectorAll('.block-product').forEach(elem => {
            let ran = Math.floor(Math.random()*(101-0))+0;
            const randHtml = `
                                <p class="abs">${ran}</p>
            `;
            elem.insertAdjacentHTML('afterbegin', randHtml);
        });
    }
    
    Up.addEventListener('click', function(){
        const sortedUp = Sortblock.sort(function(a, b){
            let first = +a.querySelector('.prise-text').textContent
            let sec = +b.querySelector('.prise-text').textContent
    
            return sec - first
        });
        while (document.querySelector('.grid-product').firstChild) {
            document.querySelector('.grid-product').removeChild(document.querySelector('.grid-product').firstChild);
        }
    
        sortedUp.forEach(i => {
            document.querySelector('.grid-product').appendChild(i)
        })
    });
    Down.addEventListener('click', function(){
        const sortedDown = Sortblock.sort(function(a, b){
            let first = +a.querySelector('.prise-text').textContent
            let sec = +b.querySelector('.prise-text').textContent
    
            return first - sec
        });
        while (document.querySelector('.grid-product').firstChild) {
            document.querySelector('.grid-product').removeChild(document.querySelector('.grid-product').firstChild);
        }
    
        sortedDown.forEach(i => {
            document.querySelector('.grid-product').appendChild(i)
        })
    });
    Rand.addEventListener('click', function(){
        
        const sortedDown = Sortblock.sort(function(a, b){
            let first = +a.querySelector('.block-product p').textContent
            let sec = +b.querySelector('.block-product p').textContent
    
            return sec - first
        });
        while (document.querySelector('.grid-product').firstChild) {
            document.querySelector('.grid-product').removeChild(document.querySelector('.grid-product').firstChild);
        }
    
        sortedDown.forEach(i => {
            document.querySelector('.grid-product').appendChild(i)
        })
    });
}
listmenu.addEventListener('click', (event) => {
    if (event.target.classList.contains('list-menu')) return false;
    let listClass = event.target.dataset['f'];
    
    popup.forEach(elem => {
        elem.classList.remove('displayonn');
        if (elem.classList.contains(listClass)){
            elem.classList.add('displayonn');
            pback.classList.add('displayonn');
        }
    });
    
});
pback.addEventListener('click', function(){
    body.classList.remove('scrollnone');
    pback.classList.remove('displayonn');
    popup.forEach(elem => {
        elem.classList.remove('displayonn');
    });
    
});
body.addEventListener('click', function (event) {
    if (event.target.hasAttribute('data-catalog')) {
        catalogmenu.classList.toggle('displayonn')


    } else if (event.target.hasAttribute('data-list')) {
        catalogmenu.classList.add('displayonn')
    }
    else {
        catalogmenu.classList.remove('displayonn')
    }
});
body.addEventListener('mouseover', function (event) {
    if (event.target.hasAttribute('data-one')) {
        stat.classList.add('displayonn')
    } else {
        stat.classList.remove('displayonn')
    }
    if (event.target.hasAttribute('data-two')) {
        ruck.classList.add('displayonn')
    } else {
        ruck.classList.remove('displayonn')
    }
    if (event.target.hasAttribute('data-tree')) {
        brel.classList.add('displayonn')
    } else {
        brel.classList.remove('displayonn')
    }
});
if (Register) {
    Register.onsubmit = function(event) {
        event.preventDefault();
        
        if (document.querySelector('[name=newPass]').value === document.querySelector('[name=newPass2]').value ) {
            Register.submit();
        }
        else {
            alert('Ошибка! Может пароли не совпадают?');
        }
    }
}
if (register) {
    register.addEventListener('click', function(){
        document.querySelector('.register-form').classList.add('displayonn');
    });
}
if (document.querySelector('.Recommendations')) {
    catalogmenu.addEventListener('click', (event) => {
        if (!event.target.classList.contains('url-product')) return false;
        url.forEach(elem => {
            window.scrollTo({
                top: 1000,
                behavior: "smooth"
            });
        });
        
    });
} else {
    catalogmenu.addEventListener('click', (event) => {
        if (!event.target.classList.contains('url-product')) return false;
        url.forEach(elem => {
            location.href = "/supphire";
        });
        
    });
}
if (prise) {
    Phead.addEventListener('click', function (event) {
        if (event.target.classList.contains('shop')) {
            let blockinfo = {
                photo: `${document.querySelector('.photo img').getAttribute('src')}`,
                name: document.querySelector('.text h2').innerText,
                prise: document.querySelector('.text h3').innerText
            };
    
            let array;
            if (localStorage.getItem('product') === null) {
                array = []
            } else {
                array = JSON.parse(localStorage.getItem('product'))
            }
            array.push(blockinfo)
            if (array.length > 3) {
                alert('Вы не можете добавить больше 3 товаров, пожалуйста, очистите корзину');
                location.href = 'curt';
            } else {
                localStorage.setItem('product', JSON.stringify(array));
                location.href = 'curt';
            }

        } else return false
        

    });
    
} 
if (order) { 
    if (localStorage.getItem('product') === null) { 
        document.querySelector('.order-block').classList.add('displayoff');
        document.querySelector('.end').classList.add('displayonn');
    } else {
        const local = JSON.parse(localStorage.getItem('product'));
        let sum = 0;
        for (let i = 0; i < local.length; i++) {
            const html = `
                <div class="btn">  
                    <img src="${local[i].photo}" alt="">
                    <div class="text" >
                        <h3>${local[i].name}</h3>
                        <p>${local[i].prise} ₽</p>
                    </div>
                </div>
            `;
            if (local.length >= 2) {
                sum += Number(local[i].prise);
            } else {
                sum = Number(local[i].prise)
            }
        productcurt.insertAdjacentHTML('beforeend', html);
        }
        const html2 = `
            <div class="prise">  
                <p>Сумма вышего заказа = ${sum} ₽</p>
            </div>
            `;  
        pc.insertAdjacentHTML('beforeend', html2);
        orderbtn.addEventListener('click', function(){
            if (document.querySelector('.check').value !=="" && document.querySelector('.check2').value !=="") {
                document.querySelector('.order-block').classList.add('displayoff');
                document.querySelector('.ofer').classList.add('displayonn');
                localStorage.clear();
                if (document.querySelector('.prise')) {
                    if (document.querySelector('.promo').value == 'Reportles'){
                        let skidsum = sum * 0.70; 
                        const skid = `<p>Окончательная сумма заказа = ${skidsum} ₽</p>`;
                        document.querySelector('.ofer').insertAdjacentHTML('beforeend', skid);
                    }else {
                        const skid = `<p>Окончательная сумма заказа = ${sum} ₽</p>`;
                        document.querySelector('.ofer').insertAdjacentHTML('beforeend', skid);
                    }
                }
            }
        });
    }
    
    document.querySelector('.clear').addEventListener('click', function(){
        localStorage.clear();
        location.reload();
    });
}
if (sub) {
    let posX = 0, posY = 0, bgX = 0, bgY = 0;
    sub.onmousemove = function (e) {
        const x = e.clientX;
        const y = e.clientY;

        bgX += posX > x ? 2 : -2;
        bgY += posY > y ? 2 : -2;
        posX = x;
        posY = y;
        sub.style.backgroundPosition = `${bgX}px ${bgY}px`;
    }
    emailbtn.addEventListener('click', function(){
        if (document.querySelector('.email-input').value !== "") {
            email.classList.add('displayonn');
            pback.classList.add('displayonn');
            document.querySelector('.email-input').value = "";
        } 
    });
}
if (slid) {
    let slide = 0;
    let amount = document.querySelectorAll(".slider img").length;
    let images = document.querySelector(".images");
    function next() {
        slide++;
        if (slide === amount) slide = 0;
        images.style.transform = `translateX(-${slide}00%)`;
    }
    function back() {
        slide--;
        if (slide === -1) slide = amount - 1;
        images.style.transform = `translateX(-${slide}00%)`;
    }
    setInterval(next, 7000);
    
}
if (curt) {
    curt.addEventListener('click', function(){
        location.href = 'curt';
    });
}   
if (logo) {
    logo.addEventListener('click', function () {
        location.href = "/supphire";
    });
}
if (document.querySelector('.description')) {
    document.querySelector('.desc-btn').addEventListener('click', function(){
        if (!document.querySelector('.description-text').classList.contains('abs')) {
            return false
        } else {
            document.querySelector('.description-text').classList.remove('abs');
            document.querySelector('.specification-text').classList.add('abs');
        }
    });
    document.querySelector('.spec-btn').addEventListener('click', function(){
        if (document.querySelector('.specification-text').classList.contains('abs')) {
            document.querySelector('.specification-text').classList.remove('abs');
            document.querySelector('.description-text').classList.add('abs');
        } else {
            return false;
        }
    });
}


