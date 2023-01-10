<?php 
    require("db.php");
    $product = $db->query("SELECT * FROM product join photos ON photos.product_id = product.id")->fetchAll(2); 
    if (!empty($_POST)) {
        if (isset($_POST["newLogin"])){
            $login = $_POST['newLogin'];
            $password = md5($_POST['newPass']);
            $role = 'user';
            if ($db->query("INSERT INTO user(login, password, role) VALUES ('$login','$password', '$role') ")) {
                echo "
                <script>
                    location.href = '/supphire'
                </script>
                ";
            } else {
                print_r($db->errorInfo());
            }
        }
        
        else if (isset($_POST["login"])) {
            $login2 = $_POST['login'];
            $password2 = md5($_POST['password']); 
            $check = $db->query("SELECT * FROM user WHERE login='$login2' AND password='$password2'")->fetchAll(2);
    
            if (count($check)>0) {
                $_SESSION['user'] = $check[0];
                echo "
                    <script>
                        location.href = '/supphire'
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Неверный логин или пароль');
                        location.href = '/supphire';
                    </script>
                ";
            }
        }
        
        

    }
    if (!empty($_GET)) {
        if(isset($_GET['logout'])) {
            $_SESSION['user'] = [];
            echo "<script>
                    location.href = '/supphire';
                </script>";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supphire</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="popup-back"></div>
    <div class="popup-block ">
        <div class="popup email">
            <h2>Отлично! Вы подписались на рассылку</h2>
        </div>
        <div class="popup login">
            <?php if (empty($_SESSION['user'])){?>
                <form action="" method="POST" id="login">
                    <h2>Войти</h2>
                    <input type="text" placeholder="Логин" name="login">
                    <input type="password" placeholder="Пароль" name="password">
                    <button>Войти</button>
                </form>
                <p class="Wreg">Еще не зарегистрированы?</p>
                <form action="" method="POST" class="register-form">
                    <h2>Зарегистрироваться</h2>
                    <input type="text" placeholder="Логин" name="newLogin">
                    <input type="password" placeholder="Пароль" name="newPass">
                    <input type="password" placeholder="Повторите пароль" name="newPass2">
                    <button>Зарегестрироваться!</button>
                </form>
            <?php } else { ?>
            
                <a href="?logout" class="logout">Выйти</a>
                <p><b>промокод</b> - Reportles  <br> -70% на вашу покупку 😊</p>
            <?php }?>
        </div>
        <div class="popup faq">
            <p><b>Какое время доставки?</b> - В среднем около 7 дней</p>
            <p><b>Вы доставляете в другие страны?</b> - К сожалению, мы не работаем за рубежом</p>
            <p><b>Могу ли я вернуть товар, если он не понравится?</b> - Конечно, вы можете отказать курьеру указав причину или оформить возрват</p>
        </div>
        <div class="popup about">
            <p>Компания Supphire была основана в 2022 году, нам было очень интересно создать свой интернет магазин, чтобы радовать геймеров </p>
        </div>
        <div class="popup contact">
            <div class="phone">
                <h3>Телефон</h3>
                <p><a href="tel:+74545435435">8(916)717-45-04</a></p>
            </div>
            <div class="address">
                <h3>Адрес</h3>
                <p>г. Москва ул. Большая майская д. 3 </p>
                <p>г. Москва ул. Новобережная д. 23 </p>
            </div>
        </div>
    </div>

    <header>
        <div class="catalog" data-catalog> 
            <div class="catalog-btn" data-catalog> 
                <h2 class="catalog-click" data-catalog>Каталог</h2>  
                <svg class="catalog-click" data-catalog enable-background="new 0 0 32 32"  id="Слой_1" version="1.1" viewBox="0 0 32 32"  xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M24.285,11.284L16,19.571l-8.285-8.288c-0.395-0.395-1.034-0.395-1.429,0  c-0.394,0.395-0.394,1.035,0,1.43l8.999,9.002l0,0l0,0c0.394,0.395,1.034,0.395,1.428,0l8.999-9.002  c0.394-0.395,0.394-1.036,0-1.431C25.319,10.889,24.679,10.889,24.285,11.284z"  id="Expand_More"/><g/><g/><g/><g/><g/><g/></svg>
            </div>
            <ul class="catalog-menu" data-catalog>
                <li class="one"  data-one data-list>Статуэтки</li>
                <ul class="one-one"  data-one data-list>
                    <li data-one class="url-product">League of legends</li>
                </ul>
                <li class="two" data-two data-list >Переферия</li>
                <ul class="two-one" data-two data-list>
                    <li data-two class="url-product">Мышки</li>
                </ul>
                <li class="tree" data-tree data-list>Аксессуары</li>
                <ul class="tree-one" data-tree data-list>
                    <li data-tree class="url-product">League of legends</li>
                </ul>
            </ul>
        </div>

        <div class="logo">
            <svg width="56" height="55" viewBox="0 0 56 55" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 14.766L10 2H22.1923M2 14.766L28 52M2 14.766H16M54 14.766L46 2H34M54 14.766L28 52M54 14.766H40M28 52L40 14.766M28 52L16 14.766M40 14.766L34 2M40 14.766H16M34 2H22.1923M22.1923 2L16 14.766" stroke="white" stroke-width="3"/>
            </svg>
        </div>
        
        <div class="menu">
            <ul class="list-menu">
                <li data-f="login">
                <?php if(empty($_SESSION['user'])) {?>
                    Вход
                <?php } else {?>
                    <svg data-f="login" version="1.0" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg"
                        width="30" height="30" viewBox="0 0 512.000000 512.000000"
                        preserveAspectRatio="xMidYMid meet">
                        <g data-f="login" transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                        fill="white" stroke="none">
                        <path data-f="login" d="M2327 5110 c-336 -36 -613 -115 -906 -261 -501 -248 -902 -649 -1150
                        -1150 -362 -727 -362 -1551 0 -2278 249 -502 648 -901 1150 -1150 727 -362
                        1551 -362 2278 0 868 430 1421 1322 1421 2289 0 852 -431 1654 -1145 2132
                        -301 201 -671 344 -1038 399 -153 23 -474 33 -610 19z m363 -594 c385 -58 643
                        -270 746 -611 24 -79 27 -108 28 -230 1 -330 -96 -534 -469 -990 -159 -194
                        -244 -342 -286 -500 -19 -68 -22 -109 -23 -268 -1 -175 -2 -190 -20 -203 -16
                        -11 -67 -14 -251 -14 -278 0 -264 -7 -276 128 -24 279 5 464 111 689 63 133
                        129 233 279 422 232 291 297 409 323 589 35 239 -79 417 -302 473 -69 17 -265
                        17 -345 0 -94 -21 -217 -69 -291 -113 -103 -62 -104 -62 -191 162 -39 102 -72
                        193 -72 203 -3 65 268 194 507 242 178 36 377 44 532 21z m-172 -3140 c175
                        -47 280 -207 270 -413 -9 -192 -121 -325 -303 -363 -194 -40 -386 72 -440 256
                        -19 65 -21 184 -5 246 58 213 264 331 478 274z"/>
                        </g>
                    </svg>
                <?php }?>
                </li>
                <li data-f="faq">FAQ</li>
                <li data-f="about">О нас</li>
                <li data-f="contact">Контакты</li>
                <li>
                    <svg class="curt" xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                </li>
            </ul>
        </div>
    </header>

    <div class="slider">
            <button onclick="back()">
                    <svg width="11px" height="20px" viewBox="0 0 11 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenod">
                        <g id="Rounded" transform="translate(-548.000000, -3434.000000)">
                            <g id="Navigation" transform="translate(100.000000, 3378.000000)">
                                <g id="-Round-/-Navigation-/-arrow_back_ios" transform="translate(442.000000, 54.000000)">
                                    <g>
                                        <polygon id="Path" opacity="0.87" points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M16.62,2.99 C16.13,2.5 15.34,2.5 14.85,2.99 L6.54,11.3 C6.15,11.69 6.15,12.32 6.54,12.71 L14.85,21.02 C15.34,21.51 16.13,21.51 16.62,21.02 C17.11,20.53 17.11,19.74 16.62,19.25 L9.38,12 L16.63,4.75 C17.11,4.27 17.11,3.47 16.62,2.99 Z" id="🔹-Icon-Color" fill="#1D1D1D"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                    </svg>
            </button>
            <div class="slider-block">
                    <div class="images">
                        <img class="img" src="img/promo.jpg" alt="">
                        <img class="img" src="img/promo1.jpg" alt="">
                        <img class="img" src="img/promo2.jpg" alt="">
                    </div>
            </div>
            <button onclick="next()">
                <svg width="11px" height="20px" viewBox="0 0 11 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Rounded" transform="translate(-345.000000, -3434.000000)">
                        <g id="Navigation" transform="translate(100.000000, 3378.000000)">
                            <g id="-Round-/-Navigation-/-arrow_forward_ios" transform="translate(238.000000, 54.000000)">
                                <g>
                                    <polygon id="Path" opacity="0.87" points="24 24 0 24 0 0 24 0"></polygon>
                                    <path d="M7.38,21.01 C7.87,21.5 8.66,21.5 9.15,21.01 L17.46,12.7 C17.85,12.31 17.85,11.68 17.46,11.29 L9.15,2.98 C8.66,2.49 7.87,2.49 7.38,2.98 C6.89,3.47 6.89,4.26 7.38,4.75 L14.62,12 L7.37,19.25 C6.89,19.73 6.89,20.53 7.38,21.01 Z" id="🔹-Icon-Color" fill="#1D1D1D"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
                </svg>
            </button>
    </div>

    <main>
        <h2>Не переживайте, у нас</h2>
        <div class="aboutme">
         
            <div class="aboutme-block">
                <div class="icon">
                <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                    <style type="text/css">
                        .st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                        
                            .st1{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:3;}
                        .st2{fill:none;stroke:#000000;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;}
                        .st3{fill:none;}
                    </style>
                    <polyline class="st0" points="2,9 19,9 19,24 10,24 "/>
                    <circle class="st0" cx="24" cy="24" r="2"/>
                    <circle class="st0" cx="8" cy="24" r="2"/>
                    <polyline class="st0" points="19,24 19,13 25,13 29,18 29,24 26,24 "/>
                    <line class="st0" x1="4" y1="13" x2="13" y2="13"/>
                    <line class="st0" x1="2" y1="17" x2="11" y2="17"/>
                    <rect x="-288" y="-432" class="st3" width="536" height="680"/>
                    </svg>
                </div>
                <p>Быстрая доставка в сроки в течении 7 дней</p>
            </div>
            <div class="aboutme-block">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z"></path><polyline points="2.32 6.16 12 11 21.68 6.16"></polyline><line x1="12" y1="22.76" x2="12" y2="11"></line>
                    </svg>
                </div>
                <p>Качественная упаковка, мы всегда переживаем о качестве товаров</p>
            </div>
            <div class="aboutme-block">
                <div class="icon">
                    <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                    <style type="text/css">
                        .st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                        .st1{fill:none;stroke:#000000;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;}
                    </style>
                    <path class="st0" d="M25,6.7c-3.4,0-6.6-1.4-9-3.7c-2.4,2.3-5.6,3.7-9,3.7C5.6,6.7,4.3,6.4,3,6c0,14,5.5,19.6,13,23
                        c7.5-3.4,13-9,13-23C27.7,6.4,26.4,6.7,25,6.7z"/>
                    <polyline class="st0" points="12,16 15,19 21,13 "/>
                    </svg>
                </div>
                <p>Проверка товара, перед получением. А также легкий возврат</p>
            </div>
            <div class="aboutme-block">
                <div class="icon">
                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>person</title>
                        <desc>Created with Sketch.</desc>
                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Rounded" transform="translate(-138.000000, -4102.000000)">
                                <g id="Social" transform="translate(100.000000, 4044.000000)">
                                    <g id="-Round-/-Social-/-person" transform="translate(34.000000, 54.000000)">
                                        <g>
                                            <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12,12 C14.21,12 16,10.21 16,8 C16,5.79 14.21,4 12,4 C9.79,4 8,5.79 8,8 C8,10.21 9.79,12 12,12 Z M12,14 C9.33,14 4,15.34 4,18 L4,19 C4,19.55 4.45,20 5,20 L19,20 C19.55,20 20,19.55 20,19 L20,18 C20,15.34 14.67,14 12,14 Z" id="🔹-Icon-Color" fill="#1D1D1D"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <p>Быстрая поддержка и приятные операторы</p>
            </div>
        </div>

        <div class="product">
            <h1>Товары</h1>
            <ul class="btn-sort">
                <li><p class="Up">Сначала дорогие</p></li>
                <li><p class="Down">Сначала дешевые</p></li>
                <li><p class="Rand">Хит продаж</p></li>
            </ul>
            <div class="grid-product">

                    <?php foreach($product as $item) {?>
                        <a href="product.php?id=<?php echo $item['product_id']?>">
                            <div class="block-product">
                                <div class="prise-text abc"><?php echo $item['prise']?></div>
                                <img src="<?php echo $item['url']?>" alt="" > 
                                <h3><?php echo $item['name']?></h3>
                                <button>Подробнее</button>
                            </div>
                        </a>
                    <?php }?>
            </div>
        </div>
        
        <h1>Расскажем интересные новости</h1>
        <div class="Recommendations">
                <div class="rec-block">
                    <p>Фигурки нашего подписчика</p>
                </div>
                <div class="rec-block">
                    <p>Рабочий стол нашего подписчика</p>
                </div>
                <div class="rec-block">
                    <p>Ближайшие игры на 2022 год</p>
                </div>
                <div class="rec-block">
                    <p>Как сэкономить на нашем сайте?</p>
                    <p>Очень просто, зарегестрируйтесь и получите скидку на первую покупку</p>
                </div>
                <div class="rec-block">
                    <p>Мощная игровая переферия от подписчика</p>
                </div>
        </div>
        
    </main>

    <div class="subscription">
            <div class="subscription-block">
                <h3>Подпишись на рассылку, чтобы оставаться в курсе новостей!</h3>
                <form action="">
                    <input class="email-input" type="text" placeholder="EMAIL" >
                    <button type="button" class="email-btn">Подписаться!</button>
                </form>
            </div>
            
    </div>

    <footer>
        <div class="footer-block-one">
            <h3>Контакты</h3>
            <div class="contact">
                <a href="tel:+74545435435">8(916)717-45-04</a>
                
            </div>
        </div>

        <div class="footer-logo">
            <h1>Supphire</h1>
            <p>2022 Все права защищены</p>
        </div>
        
        <div class="footer-block-two">
            <h3>Соц. сети</h3>
            <div class="social">
                <a href="https://vk.com/">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="548.358px" height="548.358px" viewBox="0 0 548.358 548.358" style="enable-background:new 0 0 548.358 548.358;"
                        xml:space="preserve">
                        <g>
                        <path d="M545.451,400.298c-0.664-1.431-1.283-2.618-1.858-3.569c-9.514-17.135-27.695-38.167-54.532-63.102l-0.567-0.571
                            l-0.284-0.28l-0.287-0.287h-0.288c-12.18-11.611-19.893-19.418-23.123-23.415c-5.91-7.614-7.234-15.321-4.004-23.13
                            c2.282-5.9,10.854-18.36,25.696-37.397c7.807-10.089,13.99-18.175,18.556-24.267c32.931-43.78,47.208-71.756,42.828-83.939
                            l-1.701-2.847c-1.143-1.714-4.093-3.282-8.846-4.712c-4.764-1.427-10.853-1.663-18.278-0.712l-82.224,0.568
                            c-1.332-0.472-3.234-0.428-5.712,0.144c-2.475,0.572-3.713,0.859-3.713,0.859l-1.431,0.715l-1.136,0.859
                            c-0.952,0.568-1.999,1.567-3.142,2.995c-1.137,1.423-2.088,3.093-2.848,4.996c-8.952,23.031-19.13,44.444-30.553,64.238
                            c-7.043,11.803-13.511,22.032-19.418,30.693c-5.899,8.658-10.848,15.037-14.842,19.126c-4,4.093-7.61,7.372-10.852,9.849
                            c-3.237,2.478-5.708,3.525-7.419,3.142c-1.715-0.383-3.33-0.763-4.859-1.143c-2.663-1.714-4.805-4.045-6.42-6.995
                            c-1.622-2.95-2.714-6.663-3.285-11.136c-0.568-4.476-0.904-8.326-1-11.563c-0.089-3.233-0.048-7.806,0.145-13.706
                            c0.198-5.903,0.287-9.897,0.287-11.991c0-7.234,0.141-15.085,0.424-23.555c0.288-8.47,0.521-15.181,0.716-20.125
                            c0.194-4.949,0.284-10.185,0.284-15.705s-0.336-9.849-1-12.991c-0.656-3.138-1.663-6.184-2.99-9.137
                            c-1.335-2.95-3.289-5.232-5.853-6.852c-2.569-1.618-5.763-2.902-9.564-3.856c-10.089-2.283-22.936-3.518-38.547-3.71
                            c-35.401-0.38-58.148,1.906-68.236,6.855c-3.997,2.091-7.614,4.948-10.848,8.562c-3.427,4.189-3.905,6.475-1.431,6.851
                            c11.422,1.711,19.508,5.804,24.267,12.275l1.715,3.429c1.334,2.474,2.666,6.854,3.999,13.134c1.331,6.28,2.19,13.227,2.568,20.837
                            c0.95,13.897,0.95,25.793,0,35.689c-0.953,9.9-1.853,17.607-2.712,23.127c-0.859,5.52-2.143,9.993-3.855,13.418
                            c-1.715,3.426-2.856,5.52-3.428,6.28c-0.571,0.76-1.047,1.239-1.425,1.427c-2.474,0.948-5.047,1.431-7.71,1.431
                            c-2.667,0-5.901-1.334-9.707-4c-3.805-2.666-7.754-6.328-11.847-10.992c-4.093-4.665-8.709-11.184-13.85-19.558
                            c-5.137-8.374-10.467-18.271-15.987-29.691l-4.567-8.282c-2.855-5.328-6.755-13.086-11.704-23.267
                            c-4.952-10.185-9.329-20.037-13.134-29.554c-1.521-3.997-3.806-7.04-6.851-9.134l-1.429-0.859c-0.95-0.76-2.475-1.567-4.567-2.427
                            c-2.095-0.859-4.281-1.475-6.567-1.854l-78.229,0.568c-7.994,0-13.418,1.811-16.274,5.428l-1.143,1.711
                            C0.288,140.146,0,141.668,0,143.763c0,2.094,0.571,4.664,1.714,7.707c11.42,26.84,23.839,52.725,37.257,77.659
                            c13.418,24.934,25.078,45.019,34.973,60.237c9.897,15.229,19.985,29.602,30.264,43.112c10.279,13.515,17.083,22.176,20.412,25.981
                            c3.333,3.812,5.951,6.662,7.854,8.565l7.139,6.851c4.568,4.569,11.276,10.041,20.127,16.416
                            c8.853,6.379,18.654,12.659,29.408,18.85c10.756,6.181,23.269,11.225,37.546,15.126c14.275,3.905,28.169,5.472,41.684,4.716h32.834
                            c6.659-0.575,11.704-2.669,15.133-6.283l1.136-1.431c0.764-1.136,1.479-2.901,2.139-5.276c0.668-2.379,1-5,1-7.851
                            c-0.195-8.183,0.428-15.558,1.852-22.124c1.423-6.564,3.045-11.513,4.859-14.846c1.813-3.33,3.859-6.14,6.136-8.418
                            c2.282-2.283,3.908-3.666,4.862-4.142c0.948-0.479,1.705-0.804,2.276-0.999c4.568-1.522,9.944-0.048,16.136,4.429
                            c6.187,4.473,11.99,9.996,17.418,16.56c5.425,6.57,11.943,13.941,19.555,22.124c7.617,8.186,14.277,14.271,19.985,18.274
                            l5.708,3.426c3.812,2.286,8.761,4.38,14.853,6.283c6.081,1.902,11.409,2.378,15.984,1.427l73.087-1.14
                            c7.229,0,12.854-1.197,16.844-3.572c3.998-2.379,6.373-5,7.139-7.851c0.764-2.854,0.805-6.092,0.145-9.712
                            C546.782,404.25,546.115,401.725,545.451,400.298z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                    </svg>
                </a>
                <a href="https://www.instagram.com/">
                    <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>instagram [#167]</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1">
                        <g id="Dribbble-Light-Preview" transform="translate(-340.000000, -7439.000000)" >
                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                <path d="M289.869652,7279.12273 C288.241769,7279.19618 286.830805,7279.5942 285.691486,7280.72871 C284.548187,7281.86918 284.155147,7283.28558 284.081514,7284.89653 C284.035742,7285.90201 283.768077,7293.49818 284.544207,7295.49028 C285.067597,7296.83422 286.098457,7297.86749 287.454694,7298.39256 C288.087538,7298.63872 288.809936,7298.80547 289.869652,7298.85411 C298.730467,7299.25511 302.015089,7299.03674 303.400182,7295.49028 C303.645956,7294.859 303.815113,7294.1374 303.86188,7293.08031 C304.26686,7284.19677 303.796207,7282.27117 302.251908,7280.72871 C301.027016,7279.50685 299.5862,7278.67508 289.869652,7279.12273 M289.951245,7297.06748 C288.981083,7297.0238 288.454707,7296.86201 288.103459,7296.72603 C287.219865,7296.3826 286.556174,7295.72155 286.214876,7294.84312 C285.623823,7293.32944 285.819846,7286.14023 285.872583,7284.97693 C285.924325,7283.83745 286.155174,7282.79624 286.959165,7281.99226 C287.954203,7280.99968 289.239792,7280.51332 297.993144,7280.90837 C299.135448,7280.95998 300.179243,7281.19026 300.985224,7281.99226 C301.980262,7282.98483 302.473801,7284.28014 302.071806,7292.99991 C302.028024,7293.96767 301.865833,7294.49274 301.729513,7294.84312 C300.829003,7297.15085 298.757333,7297.47145 289.951245,7297.06748 M298.089663,7283.68956 C298.089663,7284.34665 298.623998,7284.88065 299.283709,7284.88065 C299.943419,7284.88065 300.47875,7284.34665 300.47875,7283.68956 C300.47875,7283.03248 299.943419,7282.49847 299.283709,7282.49847 C298.623998,7282.49847 298.089663,7283.03248 298.089663,7283.68956 M288.862673,7288.98792 C288.862673,7291.80286 291.150266,7294.08479 293.972194,7294.08479 C296.794123,7294.08479 299.081716,7291.80286 299.081716,7288.98792 C299.081716,7286.17298 296.794123,7283.89205 293.972194,7283.89205 C291.150266,7283.89205 288.862673,7286.17298 288.862673,7288.98792 M290.655732,7288.98792 C290.655732,7287.16159 292.140329,7285.67967 293.972194,7285.67967 C295.80406,7285.67967 297.288657,7287.16159 297.288657,7288.98792 C297.288657,7290.81525 295.80406,7292.29716 293.972194,7292.29716 C292.140329,7292.29716 290.655732,7290.81525 290.655732,7288.98792" id="instagram-[#167]"></path>
                            </g>
                        </g>
                    </g>
                    </svg>
                </a>
                <a href="https://twitter.com">
                    <svg width="20px" height="16px" viewBox="0 0 20 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>twitter [#154]</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" >
                            <g id="Dribbble-Light-Preview" transform="translate(-60.000000, -7521.000000)" >
                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                    <path d="M10.29,7377 C17.837,7377 21.965,7370.84365 21.965,7365.50546 C21.965,7365.33021 21.965,7365.15595 21.953,7364.98267 C22.756,7364.41163 23.449,7363.70276 24,7362.8915 C23.252,7363.21837 22.457,7363.433 21.644,7363.52751 C22.5,7363.02244 23.141,7362.2289 23.448,7361.2926 C22.642,7361.76321 21.761,7362.095 20.842,7362.27321 C19.288,7360.64674 16.689,7360.56798 15.036,7362.09796 C13.971,7363.08447 13.518,7364.55538 13.849,7365.95835 C10.55,7365.79492 7.476,7364.261 5.392,7361.73762 C4.303,7363.58363 4.86,7365.94457 6.663,7367.12996 C6.01,7367.11125 5.371,7366.93797 4.8,7366.62489 L4.8,7366.67608 C4.801,7368.5989 6.178,7370.2549 8.092,7370.63591 C7.488,7370.79836 6.854,7370.82199 6.24,7370.70483 C6.777,7372.35099 8.318,7373.47829 10.073,7373.51078 C8.62,7374.63513 6.825,7375.24554 4.977,7375.24358 C4.651,7375.24259 4.325,7375.22388 4,7375.18549 C5.877,7376.37088 8.06,7377 10.29,7376.99705" id="twitter-[#154]"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
                
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
    
</body>
</html>