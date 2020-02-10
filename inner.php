<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Внутренняя страница каталога");
?>
<div class="container">
    <h1>
        <?$APPLICATION->ShowTitle()?>
    </h1>
    <style>
        input[type="number"] {
            width: 50px;
            height: 40px;
        }
		th {font-size: 13px;}
tr {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.footer__submit {
      padding: 15px;
    margin-left: -5px;
}
.footer__input {
  
    width: 100%;
    max-width: 500px;
    margin-bottom: 20px;
}
        .smallgreenbtn {
            background: #3caa37;
            color: #fff;
            padding: 5px;
            display: inline-block;
            width: 130px;
            height: 40px;
            background-color: #3caa37;
            border-radius: 5px;
            box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.15);
            font-size: 15px;
            text-transform: uppercase;
            color: #fff;
            line-height: 30px;
            margin-left: 10px;
        }
		.arrowbtns {    display: flex;
    flex-direction: column;
    width: 20px;
    height: 100%;
    align-items: center;
    justify-content: center;
    margin-left: 5px;
		}
        #myTab {
            margin-top: 40px;
        }
    </style>
    <div class="greenseparator"></div>
    <div class="row">
        <div class="col-md-3">
            <img src="../images/img_td2.png" alt="">
        </div>
        <div class="col-md-9">

            <p>Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика
                занимается производством большого объёма режущего инструмента высокого качества. Продукция
                данного завода уже давно знакома Российским потребителям под различными торговыми марками
                Европейских производителей, которые часть продукции размещают в Китае. </p>

            <p>Также компания Tideway является крупнейшим импортёром в Азии твёрдого сплава именно
                Люксембургской фабрики Ceratizit, что делает их продукцию значимо отличной от других
                производителей в данном регионе.</p>
            <p>Компания Тулдирект представляет продукцию завода под их собственным брендом. Без двойных
                логистических перемещений из Азии в Европу, затем из Европы в Россию; без многих наценок
                различных заинтересованных сторон. Мы рады предложить качественную продукцию завода со склада в
                Москве по самым справедливым ценам на рынке.</p>
        </div>

    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="vibor-tab" data-toggle="tab" href="#vibor" role="tab" aria-controls="vibor"
                aria-selected="true">ВЫБОР ТОВАРА</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="descriptiontab-tab" data-toggle="tab" href="#descriptiontab" role="tab"
                aria-controls="descriptiontab" aria-selected="false">ОПИСАНИЕ ТОВАРА</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="zatochka-tab" data-toggle="tab" href="#zatochka" role="tab" aria-controls="zatochka"
                aria-selected="false">ЗАТОЧКА</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video"
                aria-selected="false">ВИДЕО</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="vibor" role="tabpanel" aria-labelledby="vibor-tab">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="articul" >Артикул</th>
                            <th scope="col" class="cart_item_name">Название</th>
                            <th scope="col" class="gabarit">Габарит 1</th>
                            <th scope="col" class="gabarit">Габарит 2</th>
                            <th scope="col" class="gabarit">Габарит 3</th>
                            <th scope="col" class="gabarit">Габарит 4</th>
                            <th scope="col" class="gabarit">Габарит 5</th>
                           <th scope="col" class="priceitem">Цена, руб<div class="arrowbtns"> <i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></div></th>
                            <th scope="col" class="itemstatus">Наличие<div class="arrowbtns"> <i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></div></th>
                            <th scope="col" class="flexjustify zakaz">Заказ</th>
                        </tr>
                    </thead>
                    <tr>
                        <td  class="articul" >LC180170005L</td>
                        <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="priceitem">500</td>
                        <td>
                            <div class="itemstatus nalichie">в наличии</div>
                        </td>
                        <td class="flexjustify zakaz"><input type="number" name="quantity" placeholder="199">
                            <button type="button" class="smallgreenbtn">Купить</button>
                        </td>
                    </tr>
                    <tr>
                        <td  class="articul" >LC180170005L</td>
                        <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="priceitem">500</td>
                        <td>
                            <div class="itemstatus nalichie">в наличии</div>
                        </td>
                        <td class="flexjustify zakaz"><input type="number" name="quantity" placeholder="199">
                            <button type="button" class="smallgreenbtn">Купить</button>
                        </td>
                    </tr>
                    <tr>
                        <td  class="articul" >LC180170005L</td>
                        <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="priceitem">500</td>
                        <td>
                            <div class="itemstatus podzakaz">под заказ</div>
                        </td>
                        <td class="flexjustify zakaz"><input type="number" name="quantity" placeholder="199">
                            <button type="button" class="smallgreenbtn">Купить</button>
                        </td>
                    </tr>
                    <tr>
                        <td  class="articul" >LC180170005L</td>
                        <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="priceitem">500</td>
                        <td>
                            <div class="itemstatus ozidaetsa">ожидается</div>
                        </td>
                        <td class="flexjustify zakaz"><input type="number" name="quantity" placeholder="199">
                            <button type="button" class="smallgreenbtn">Купить</button>
                        </td>
                    </tr>
                    <tr>
                        <td  class="articul" >LC180170005L</td>
                        <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="priceitem">500</td>
                        <td>
                            <div class="itemstatus podzakaz">под заказ</div>
                        </td>
                        <td class="flexjustify zakaz"><input type="number" name="quantity" placeholder="199">
                            <button type="button" class="smallgreenbtn">Купить</button>
                        </td>
                    </tr>
                    <tr>
                        <td  class="articul" >LC180170005L</td>
                        <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="priceitem">500</td>
                        <td>
                            <div class="itemstatus nalichie">в наличии</div>
                        </td>
                        <td class="flexjustify zakaz"><input type="number" name="quantity" placeholder="199">
                            <button type="button" class="smallgreenbtn">Купить</button>
                        </td>
                    </tr>
                    <tr>
                        <td  class="articul" >LC180170005L</td>
                        <td class="cart_item_name">Сверло глухое Z=2+2 5x35x70 S=10x20 L, , шт</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="gabarit">5x35x70</td>
                        <td class="priceitem">500</td>
                        <td>
                            <div class="itemstatus ozidaetsa">ожидается</div>
                        </td>
                        <td class="flexjustify zakaz"><input type="number" name="quantity" placeholder="199">
                            <button type="button" class="smallgreenbtn">Купить</button>
                        </td>
                    </tr>
                </table>
            </div>






        </div>
        <div class="tab-pane fade" id="descriptiontab" role="tabpanel" aria-labelledby="descriptiontab-tab">  <p> Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика
                        занимается производством большого объёма режущего инструмента высокого качества. Продукция
                        данного завода уже давно знакома Российским потребителям под различными торговыми марками
                        Европейских производителей, которые часть продукции размещают в Китае. </p>
        </div>
        <div class="tab-pane fade" id="zatochka" role="tabpanel" aria-labelledby="zatochka-tab">3</div>
        <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="zatochka-tab"><div class="row">
                <div class="col-sm-4">
                    <div style="height: 100%; background: #C4C4C4;">video </div>
                </div>
                <div class="col-sm-8">
                    <p> Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика
                        занимается производством большого объёма режущего инструмента высокого качества. Продукция
                        данного завода уже давно знакома Российским потребителям под различными торговыми марками
                        Европейских производителей, которые часть продукции размещают в Китае. </p>
                    <p>Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика
                        занимается производством большого объёма режущего инструмента высокого качества. Продукция
                        данного завода уже давно знакома Российским потребителям под различными торговыми марками
                        Европейских производителей, которые часть продукции размещают в Китае. Tideway – огромный
                        промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика занимается
                        производством большого объёма режущего инструмента высокого качества. Продукция данного завода
                        уже давно знакома Российским потребителям под различными торговыми марками Европейских
                        производителей, которые часть продукции размещают в Китае.</p>
                </div>
            </div></div>
    </div>
    <section id="soputstvuyshie">
        <h3>Cопутствующие товары </h3>

		<div class="row" style="padding-top: 40px;">
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="cardcatalogitem">
                    <img src="/bitrix/templates/tooldirect/images/product-01.jpg" alt="">
                    <h5>Пилы дисковые Arden</h5>
                </div>
            </div>
        </div>
    </section>


    <div class="greenrow">
        <div>
            <h4>Не нашли конкретный инструмент?</h4>
            <h5>оставьте заявку — мы ответим вам в течение дня</h5>
        </div>
     <a href="#" class="order__button button button--white  button--h64 button--fz24">Заказать инструмент</a>
    </div>







    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">не нашли нужного инструмента? закажите у нас!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="yourname">Как вас зовут</label>
                                    <input type="text" class="form-control" id="yourname"
                                        placeholder="Константин Константинопольский">
                                </div>
                                <div class="form-group">
                                    <label for="yourname">Ваш телефон</label>
                                    <input type="phone" class="form-control" id="yourname"
                                        placeholder="+7(XXX)XXX-XX-XX">
                                </div>


                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="yourname">Ваша почта</label>
                                    <input type="mail" class="form-control" id="yourname"
                                        placeholder="konstantin@mail.ru">
                                </div>
                                <div class="form-group">
                                    <label for="yourname">Ваш город</label>
                                    <input type="text" class="form-control" id="yourname" placeholder="Москва">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Опишите ваши требования</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Напишите ваше сообщение тут... "></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Заказать инструмент</button>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>