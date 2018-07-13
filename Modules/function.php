<!-- Function điều hướng -->
<?php function dieuhuong()
{ ?>
    <?php
    if (isset($_GET['dieuhuong'])) {
        switch ($_GET['dieuhuong']) {
            case"home":
                home();
                break;
            case"hotro":
                hotro();
                break;
            case"login":
                login();
                break;
            case"cart":
                giohang();
                break;
            case"dssanpham":
                dssanpham();
                break;
            case"ttthanhvien":
                thongtintv();
                break;
            case"suathongtin":
                suathongtin();
                break;
            case"doimatkhau":
                suamatkhau();
                break;
            case"xemdonhang":
                xemdonhang();
                break;
            case"xemchitiethd":
                xemchitiethd();
                break;
            case"search":
                search();
                break;
            case"logout":
                unset($_SESSION['tendangnhap']);
                echo "<script>location='?';</script>";
                break;
            case"chitiet":
                chitiet();
                break;
            case"order":
                if (isset($_SESSION['tendangnhap'])) {
                    order();
                } else {
                    echo "<script>location='?dieuhuong=login&order=1';</script>";
                }
                break;
        }
    } else
        home()
    ?>
<?php } ?>

<!-- Function header -->
<?php function headerhome()
{ ?>
    <section class="container">
        <section class="col-md-3 header-left">
            <h1><a href="."><img src="images/AnhMenu/logo.png"></a></h1>
        </section>
        <section class="col-md-6 header-middle">
            <form action="?dieuhuong=search" method="post" style="border: #999 thin solid;">
                <section class="search">
                    <input type="search" name="tukhoa" required placeholder="Tìm kiếm theo tên sản phẩm"
                           value="<?php if (isset($_POST['tukhoa'])) echo $_POST['tukhoa'];
                           if (isset($_GET['tukhoa'])) echo $_GET['tukhoa']; ?>">
                </section>
                <section class="sear-sub">
                    <input type="submit" value=" ">
                </section>
                <section class="clearfix"></section>
            </form>
        </section>
        <section class="col-md-3 header-right footer-bottom">
            <ul>
                <?php if (!isset($_SESSION['tendangnhap'])) { ?>
                    <li style="width: 46%; text-align: center;">
                        <a href="?dieuhuong=login" class="item single-item hvr-outline-out button2"><i
                                    class="fa fa-user" aria-hidden="true">&nbsp;Đăng Nhập</i></a>
                    </li>
                    <li style="width: 46%; text-align: center;">
                        <a href="?dieuhuong=login" class="item single-item hvr-outline-out button2"><i
                                    class="fa fa-user-plus" aria-hidden="true">&nbsp;Đăng Ký</i></a>
                    </li>
                <?php } else { ?>
                    <li style="width: 62%; text-align: center;">
                        <a href="?dieuhuong=ttthanhvien" class="item single-item hvr-outline-out button2"><i
                                    class="fa fa-user" aria-hidden="true">&nbsp;<?= $_SESSION['tendangnhap'] ?></i></a>
                    </li>
                    <li style="width: 30%; text-align: left;">
                        <a href="?dieuhuong=logout" class="item single-item hvr-outline-out button2"><i
                                    class="fa fa-sign-out" aria-hidden="true">&nbsp;Thoát</i></a>
                    </li>
                <?php } ?>
            </ul>
        </section>
        <section class="clearfix"></section>
    </section>
<?php } ?>

<!-- Function menu -->
<?php function navhome()
{ ?>
    <!-- Menu -->
    <section class="container">
        <section class="top_nav_left">
            <section class="navbar navbar-default">
                <section class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <section class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </section>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <section class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav menu__list">
                            <li class="active menu__item menu__item--current"><a class="menu__link"
                                                                                 href="?dieuhuong=home">TRANG CHỦ<span
                                            class="sr-only">(current)</span></a></li>
                            <li class="dropdown menu__item">
                                <a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">LAPTOP CHÍNH HÃNG<span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu multi-column columns-3">
                                    <section class="row">
                                        <?php
                                        $manhom = $rownhomsp['manhom'];
                                        $sql = "select*from anh where trangthai=1 and vitri='$manhom' order by maanh desc limit 1";
                                        GLOBAL $connect;
                                        $kq1 = $connect->query($sql);
                                        $rowanh = mysqli_fetch_array($kq1);
                                        if (mysqli_num_rows($kq1) != 0) {
                                            ?>
                                            <section class="col-sm-6 multi-gd-img1 multi-gd-text ">
                                                <a href="?dieuhuong=dssanpham&manhom=<?= $rownhomsp['manhom'] ?>"><img
                                                            src="images/<?= $rowanh['duongdananh'] ?>" alt=" "/></a>
                                            </section>
                                        <?php } ?>
                                        <section class="col-sm-4 multi-gd-img">
                                            <ul class="multi-column-dropdown">
                                                <?php
                                                $sql = "select*from loaisp where trangthailoai=1";
                                                GLOBAL $connect;
                                                $kq2 = $connect->query($sql);
                                                while ($rowloaisp = mysqli_fetch_array($kq2)) { ?>
                                                    <li>
                                                        <a href="?dieuhuong=dssanpham&maloai=<?= $rowloaisp['maloai'] ?>"><?= $rowloaisp['tenloai'] ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </section>
                                        <section class="clearfix"></section>
                                    </section>
                                </ul>
                            </li>
                            <li class=" menu__item"><a class="menu__link" href="?dieuhuong=hotro">HỖ TRỢ</a></li>
                        </ul>
                    </section>
                </section>
            </section>
        </section>
        <?php if (!isset($_SESSION['CART']) || $_SESSION['CART'] == NULL) {
            $giohang = 0;
        } else {
            $giohang = count($_SESSION['CART']);
        }
        ?>
        <section class="top_nav_right">
            <section class="cart box_1">
                <a href="?dieuhuong=cart">
                    <h3>
                        <section class="total">
                            <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
                            <span class="simpleCart_total"><?= $giohang ?> Sản phẩm</span>
                    </h3>
                </a>
                <p>
                    <a onClick="if(confirm('Bạn muốn xóa giỏ hàng?')) location='?dieuhuong=cart&hanhdong=delall&vitri=1';"
                       class="simpleCart_empty">Xóa giỏ hàng</a></p>
            </section>
        </section>
        <section class="clearfix"></section>
    </section>
    <!-- //Menu-top -->
<?php } ?>

<!-- Function Banner -->
<?php function banner()
{ ?>
    <!-- banner -->
    <section class="banner-grid">
        <section id="visual">
            <section class="slide-visual">
                <!-- Slide Image Area (1000 x 424) -->
                <ul class="slide-group">
                    <?php
                    $sql = "select*from anh where vitri=5 and trangthai=1 order by maanh desc limit 3";
                    GLOBAL $connect;
                    $kq = $connect->query($sql);
                    while ($rowanhslideto = mysqli_fetch_array($kq)) { ?>
                        <li><img class="img-responsive" src="images/<?= $rowanhslideto['duongdananh'] ?>"
                                 alt="Dummy Image"/></li>
                    <?php } ?>
                </ul>
                <!-- Slide Description Image Area (316 x 328) -->
                <section class="script-wrap">
                    <ul class="script-group">
                        <?php
                        $sql = "select*from anh where vitri=6 and trangthai=1 order by maanh desc limit 3";
                        GLOBAL $connect;
                        $kq1 = $connect->query($sql);
                        while ($rowanhslidenho = mysqli_fetch_array($kq1)) { ?>
                            <li>
                                <section class="inner-script"><img class="img-responsive"
                                                                   src="images/<?= $rowanhslidenho['duongdananh'] ?>"
                                                                   alt="Dummy Image"/></section>
                            </li>
                        <?php } ?>
                    </ul>
                    <section class="slide-controller">
                        <a href="#" class="btn-prev"><img src="images/btn_prev.png" alt="Prev Slide"/></a>
                        <a href="#" class="btn-play"><img src="images/btn_play.png" alt="Start Slide"/></a>
                        <a href="#" class="btn-pause"><img src="images/btn_pause.png" alt="Pause Slide"/></a>
                        <a href="#" class="btn-next"><img src="images/btn_next.png" alt="Next Slide"/></a>
                    </section>
                </section>
                <section class="clearfix"></section>
            </section>
            <section class="clearfix"></section>
        </section>
        <script type="text/javascript" src="js/pignose.layerslider.js"></script>
        <script type="text/javascript">
            //<![CDATA[
            $(window).load(function () {
                $('#visual').pignoseLayerSlider({
                    play: '.btn-play',
                    pause: '.btn-pause',
                    next: '.btn-next',
                    prev: '.btn-prev'
                });
            });
            //]]>
        </script>
    </section>
    <!-- //banner -->
<?php } ?>

<!-- Function Home -->
<?php function home()
{ ?>
    <?php banner(); ?>
    <!-- product-nav -->
    <section class="product-easy">
        <section class="container">
            <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#horizontalTab').easyResponsiveTabs({
                        type: 'default', //Types: default, vertical, accordion
                        width: 'auto', //auto or any width like 600px
                        fit: true   // 100% fit in a container
                    });
                });

            </script>
            <section class="sap_tabs">
                <section id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                    <ul class="resp-tabs-list">
                        <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Sản phẩm mới</span></li>
                        <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Sản phẩm bán chạy</span>
                        </li>
                        <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Sản phẩm khuyến mại</span>
                        </li>
                    </ul>
                    <section class="resp-tabs-container">
                        <section class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                            <?php
                            $sql = "select * from sanpham where trangthaisp=1 order by masanpham desc limit 12";
                            GLOBAL $connect;
                            $kq = $connect->query($sql);
                            while ($rowsanpham = mysqli_fetch_array($kq)) {
                                ?>
                                <section class="col-md-3 product-men" id="product-men-img">
                                    <section class="men-pro-item simpleCart_shelfItem">
                                        <section class="men-thumb-item" title="<?= $rowsanpham['tensanpham'] ?>">
                                            <img onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>';"
                                                 title="<?= $rowsanpham['tensanpham'] ?>"
                                                 src="images/<?= $rowsanpham['anhdaidien'] ?>" alt=""
                                                 class="pro-image-front">
                                            <img onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>';"
                                                 title="<?= $rowsanpham['tensanpham'] ?>""
                                            src="images/<?= $rowsanpham['anhdaidien'] ?>" alt="" class="pro-image-back">
                                            <section class="men-cart-pro">
                                                <section class="inner-men-cart-pro">
                                                    <a href="?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>"
                                                       class="link-product-add-cart">Xem chi tiết</a>
                                                </section>
                                            </section>
                                            <span class="product-new-top" id="product-new-new"><span
                                                        class="product-new-span">NEW</span></span>
                                        </section>
                                        <section class="item-info-product ">
                                            <section class="info-product-price">
                                                <?php
                                                $gia = $rowsanpham['gia'] * (100 - $rowsanpham['khuyenmai']) / 100;
                                                ?>
                                                <span class="item_price">Giá: <?= number_format($gia, 0, ',', '.') ?>
                                                    đ</span>
                                            </section>
                                            <a href="#" class="item single-item hvr-outline-out button2"
                                               onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>';"><i
                                                        class="glyphicon glyphicon-shopping-cart"
                                                        aria-hidden="true"></i> Thêm giỏ hàng</a>
                                        </section>
                                    </section>
                                </section>
                                <?php
                            }
                            ?>
                            <section class="clearfix"></section>
                        </section>
                        <section class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
                            <?php
                            $sql = "select sanpham.tensanpham,sanpham.masanpham,sanpham.anhdaidien,sanpham.gia,sanpham.khuyenmai from sanpham,chitiethoadon,chitietsanpham,hoadon where sanpham.masanpham=chitietsanpham.masp and chitietsanpham.machitiet=chitiethoadon.machitietsp and hoadon.mahoadon=chitiethoadon.mahoadon and trangthaihoadon!=4 and trangthaisp=1 group by sanpham.masanpham order by sum(chitiethoadon.soluong) desc limit 12";
                            GLOBAL $connect;
                            $kq1 = $connect->query($sql);
                            while ($rowsanpham1 = mysqli_fetch_array($kq1)) {
                                ?>
                                <section class="col-md-3 product-men" id="product-men-img">
                                    <section class="men-pro-item simpleCart_shelfItem">
                                        <section class="men-thumb-item" title="<?= $rowsanpham1['tensanpham'] ?>">
                                            <img onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham1['masanpham'] ?>';"
                                                 title="<?= $rowsanpham1['tensanpham'] ?>"
                                                 src="images/<?= $rowsanpham1['anhdaidien'] ?>" alt=""
                                                 class="pro-image-front">
                                            <img onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham1['masanpham'] ?>';"
                                                 title="<?= $rowsanpham1['tensanpham'] ?>""
                                            src="images/<?= $rowsanpham1['anhdaidien'] ?>" alt=""
                                            class="pro-image-back">
                                            <section class="men-cart-pro">
                                                <section class="inner-men-cart-pro">
                                                    <a href="?dieuhuong=chitiet&masanpham=<?= $rowsanpham1['masanpham'] ?>"
                                                       class="link-product-add-cart">Xem chi tiết</a>
                                                </section>
                                            </section>
                                            <span class="product-new-top" id="product-new-hot"><span
                                                        class="product-new-span">HOT</span></span>

                                        </section>
                                        <section class="item-info-product ">
                                            <section class="info-product-price">
                                                <?php
                                                $gia1 = $rowsanpham1['gia'] * (100 - $rowsanpham1['khuyenmai']) / 100;
                                                ?>
                                                <span class="item_price">Giá: <?= number_format($gia1, 0, ',', '.') ?>
                                                    đ</span>
                                            </section>
                                            <a href="#" class="item single-item hvr-outline-out button2"
                                               onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham1['masanpham'] ?>';"><i
                                                        class="glyphicon glyphicon-shopping-cart"
                                                        aria-hidden="true"></i> Thêm giỏ hàng</a>
                                        </section>
                                    </section>
                                </section>
                                <?php
                            }
                            ?>
                            <section class="clearfix"></section>
                        </section>
                        <section class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                            <?php
                            $sql = "select * from sanpham where trangthaisp=1 order by khuyenmai desc limit 12";
                            GLOBAL $connect;
                            $kq2 = $connect->query($sql);
                            while ($rowsanpham2 = mysqli_fetch_array($kq2)) {
                                ?>
                                <section class="col-md-3 product-men" id="product-men-img">
                                    <section class="men-pro-item simpleCart_shelfItem">
                                        <section class="men-thumb-item" title="<?= $rowsanpham2['tensanpham'] ?>">
                                            <img onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham2['masanpham'] ?>';"
                                                 title="<?= $rowsanpham2['tensanpham'] ?>"
                                                 src="images/<?= $rowsanpham2['anhdaidien'] ?>" alt=""
                                                 class="pro-image-front">
                                            <img onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham2['masanpham'] ?>';"
                                                 title="<?= $rowsanpham2['tensanpham'] ?>""
                                            src="images/<?= $rowsanpham2['anhdaidien'] ?>" alt=""
                                            class="pro-image-back">
                                            <section class="men-cart-pro">
                                                <section class="inner-men-cart-pro">
                                                    <a href="?dieuhuong=chitiet&masanpham=<?= $rowsanpham2['masanpham'] ?>"
                                                       class="link-product-add-cart">Xem chi tiết</a>
                                                </section>
                                            </section>
                                            <span class="product-new-top" id="product-new-sale"><span
                                                        class="product-new-span"><?= $rowsanpham2['khuyenmai'] ?>
                                                    %</span></span>
                                        </section>
                                        <section class="item-info-product">
                                            <section class="info-product-price">
                                                <?php
                                                $gia2 = $rowsanpham2['gia'] * (100 - $rowsanpham2['khuyenmai']) / 100;
                                                ?>
                                                <span class="item_price">Giá: <?= number_format($gia2, 0, ',', '.') ?>
                                                    đ</span>
                                            </section>
                                            <a href="#" class="item single-item hvr-outline-out button2"
                                               onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham2['masanpham'] ?>';"><i
                                                        class="glyphicon glyphicon-shopping-cart"
                                                        aria-hidden="true"></i> Thêm giỏ hàng</a>
                                        </section>
                                    </section>
                                </section>
                                <?php
                            }
                            ?>
                            <section class="clearfix"></section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- //product-nav -->
<?php } ?>

<!-- Function Hỗ trợ -->
<?php function hotro()
{ ?>
    <!-- banner -->
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Hỗ Trợ</li>
        </ol>
    </section>
    <!-- contact -->
    <section class="contact">
        <section class="container">
            <section class="contact-grids">
                <section class="col-md-4 contact-grid text-center animated wow slideInLeft" data-wow-delay=".5s">
                    <section class="contact-grid1">
                        <i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
                        <h4>Địa chỉ</h4>
                        <p>19 Nguyễn Trãi, Thanh Xuân <span>Hà Nội.</span></p>
                    </section>
                </section>
                <section class="col-md-4 contact-grid text-center animated wow slideInUp" data-wow-delay=".5s">
                    <section class="contact-grid2">
                        <i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
                        <h4>Liên lạc</h4>
                        <p>+841672923739<span>+1273 748 730</span></p>
                    </section>
                </section>
                <section class="col-md-4 contact-grid text-center animated wow slideInRight" data-wow-delay=".5s">
                    <section class="contact-grid3">
                        <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
                        <h4>Email</h4>
                        <p><a href="">manhhieu@gmail.com</a><span><a href="">shoptat@gmail.com</a></span></p>
                    </section>
                </section>
                <section class="clearfix"></section>
            </section>
            <section class="map wow fadeInDown animated" data-wow-delay=".5s">
                <h3 class="tittle">Tìm kiếm trên bản đồ</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.750219342511!2d105.8180533145323!3d21.002647386012566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac84f5c3d53b%3A0xa50fb9b22f3d2b12!2zMTkgTmd1eeG7hW4gVHLDo2ksIE5nw6MgVMawIFPhu58sIFRoYW5oIFh1w6JuLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1476924005382"
                        width="600" height="450" frameborder="0" style="border:0"></iframe>
            </section>
        </section>
    </section>
    <!-- //contact -->
<?php } ?>

<!--Funcion giỏ hàng-->
<?php function giohang()
{ ?>
    <?php
    if (isset($_SESSION['CART']))
        $cart = $_SESSION['CART'];
    if (isset($_GET['machitiet']))
        $machitiet = $_GET['machitiet'];
    if (isset($_GET['soluong']))
        $soluong = $_GET['soluong'];
    if (isset($_GET['hanhdong']))
        $hanhdong = $_GET['hanhdong'];
    if (isset($hanhdong)) {
        switch ($hanhdong) {
            case"addtocart":
                if (isset($cart)) {
                    if (array_key_exists($machitiet, $cart))
                        $cart[$machitiet] += $soluong;
                    else
                        $cart[$machitiet] = $soluong;
                } else {
                    $cart[$machitiet] = $soluong;
                }
                $_SESSION['CART'] = $cart;
                header("Location: .?dieuhuong=cart");
                break;
            case"del":
                unset($cart[$machitiet]);
                $_SESSION['CART'] = $cart;
                break;
            case"delall":
                unset($cart);
                unset($_SESSION['CART']);
                break;
            case"update":
                foreach (array_keys($cart) as $key) {
                    $cart[$key] = $_POST[$key];
                }
                $_SESSION['CART'] = $cart;
                break;
            case"order":
                if (isset($_SESSION['tendangnhap']))
                    header("Location: .?dieuhuong=order");
                else
                    header("Location: .?dieuhuong=login&order=1");
                break;
        }
    }
    ?>
    <!-- banner -->
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <!-- breadcrumb -->
    <section class="container">
        <ol class="breadcrumb" style="margin-bottom: 0px">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Giỏ hàng</li>
        </ol>
    </section>
    <!-- //breadcrumb -->
    <!-- check out -->
    <section class="checkout">
        <section class="container">
            <h3 style="color:red;text-align:center;font-weight:bold;font-size:30px;">Giỏ hàng của tôi</h3>
            <?php if (!isset($cart) || $cart == NULL) { ?>
                <section style="text-align:center;font-weight:bold;font-size:30px;">Không có sản phẩm nào trong giỏ
                    hàng
                </section>
            <?php } else { ?>
                <form method="post" action="?dieuhuong=cart&hanhdong=update">
                    <?php
                    $listmachitiet = "";
                    foreach (array_keys($cart) as $key)
                        $listmachitiet .= $key . ",";
                    $listmachitiet .= "0";
                    $sql = "select chitietsanpham.masp,sanpham.tensanpham,sanpham.anhdaidien,sanpham.gia,sanpham.khuyenmai,mau.tenmau,size.tensize,chitietsanpham.machitiet from chitietsanpham,mau,size,sanpham where sanpham.masanpham=chitietsanpham.masp and mau.mamau=chitietsanpham.mamau and size.masize=chitietsanpham.masize and  machitiet in ($listmachitiet)";
                    GLOBAL $connect;
                    $kq = $connect->query($sql);
                    $tongtien = 0;
                    ?>
                    <section class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
                        <table class="timetable_sub">
                            <thead>
                            <tr>
                                <th width="15%">Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Màu</th>
                                <th>Size</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($kq as $rowsanpham) {
                                ?>
                                <tr>
                                    <td class="invert-image">
                                        <img src="images/<?= $rowsanpham['anhdaidien'] ?>" alt=""
                                             class="img-responsive"/>
                                    </td>
                                    <td class="invert"><a
                                                href="?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masp'] ?>"><?= $rowsanpham['tensanpham'] ?></a>
                                    </td>
                                    <td class="invert"><?= $rowsanpham['tenmau'] ?></td>
                                    <td class="invert"><?= $rowsanpham['tensize'] ?></td>
                                    <?php
                                    $dongia = $rowsanpham['gia'] * (100 - $rowsanpham['khuyenmai']) / 100;
                                    $thanhtien = $dongia * $cart[$rowsanpham['machitiet']];
                                    $tongtien += $thanhtien;
                                    ?>
                                    <td class="invert"><?= number_format($dongia, 0, ',', '.') ?> vnđ</td>
                                    <td class="invert">
                                        <input type="number" name="<?= $rowsanpham['machitiet'] ?>" min="1" max="99"
                                               value="<?= $cart[$rowsanpham['machitiet']] ?>" class="soluongajax">
                                    </td>
                                    <td class="invert" style="color: rgba(247, 40, 40, 0.92);font-weight: bold;"
                                        id="thanhtienajax"><?= number_format($thanhtien, 0, ',', '.') ?> vnđ
                                    </td>
                                    <td>
                                        <a onClick="if(confirm('Bạn muốn xóa sản phẩm này?')) return true; else return false;"
                                           href="?dieuhuong=cart&hanhdong=del&machitiet=<?= $rowsanpham['machitiet'] ?>">
                                            <button type="button" class="btn btn-xs btn-info"><span
                                                        class="fa fa-trash"></span> Xóa
                                            </button>
                                        </a></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="11" id="sum-pro">Tổng chi phí:
                                    <span><?= number_format($tongtien, 0, ',', '.') ?> vnđ</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </section>
                    <section class="checkout-left" style="">
                        <section class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                            <input type="button" onClick="location='.';" value="Tiếp tục mua" class="btn btn-default">
                        </section>
                        <section class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                            <input type="submit" value="Cập nhật giỏ hàng" class="btn btn-default">
                        </section>
                        <section class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                            <input type="button"
                                   onClick="if(confirm('Bạn muốn xóa giỏ hàng?')) location='?dieuhuong=cart&hanhdong=delall';"
                                   value="Xóa giỏ hàng" class="btn btn-default">
                        </section>
                        <section class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                            <input type="button" onClick="location='?dieuhuong=cart&hanhdong=order'" value="Đặt hàng"
                                   class="btn btn-default">
                        </section>
                        <section class="clearfix"></section>
                    </section>
                </form>
                <?php
            }
            ?>
        </section>
    </section>
    <!-- //check out -->
<?php } ?>

<?php function coupons()
{ ?>
    <section class="container">
        <section class="coupons-grids text-center">
            <section class="col-md-3 coupons-gd">
                <h3>Hướng dẫn mua sản phẩm một cách đơn giản</h3>
            </section>
            <section class="col-md-3 coupons-gd">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <h4>CHỌN SẢN PHẨM</h4>
                <p>Chọn sản phẩm bạn muốn mua và tiếp tục với việc thêm vào giỏ hàng.</p>
            </section>
            <section class="col-md-3 coupons-gd">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <h4>ĐĂNG NHẬP TÀI KHOẢN</h4>
                <p>Bạn có thể đăng ký với việc click vào biểu tượng phía đầu trang nếu chưa có tài khoản.</p>
            </section>
            <section class="col-md-3 coupons-gd">
                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                <h4>THANH TOÁN</h4>
                <p>Click vào biểu tượng giỏ hàng ở phía trên và tiến hành thanh toán.</p>
            </section>
            <section class="clearfix"></section>
        </section>
    </section>
<?php } ?>

<?php function footer()
{ ?>
    <section class="container">
        <section class="col-md-3 footer-left">
            <h2><a href="."><img src="images/AnhMenu/logo.png" alt=" "/></a></h2>
        </section>
        <section class="col-md-9 footer-right">
            <section class="sign-grds">
                <section class="col-md-4 sign-gd">
                    <h4>SiteMap</h4>
                    <ul>
                        <li><span class="fa fa-caret-right"></span> <a href="?dieuhuong=home">Trang chủ</a></li>
                        <?php
                        $sql = "select*from nhomsp where trangthainhom=1";
                        GLOBAL $connect;
                        $kq = $connect->query($sql);
                        while ($rownhomsp = mysqli_fetch_array($kq)) { ?>
                            <li><span class="fa fa-caret-right"></span> <a
                                        href="?dieuhuong=dssanpham&manhom=<?= $rownhomsp['manhom'] ?>"><?= $rownhomsp['tennhom'] ?></a>
                            </li>
                        <?php } ?>
                        <li><span class="fa fa-caret-right"></span> <a href="?dieuhuong=hotro">Hỗ trợ</a></li>
                    </ul>
                </section>

                <section class="col-md-4 sign-gd-two">
                    <h4>Thông tin Shop</h4>
                    <ul>
                        <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Địa chỉ: 19, Nguyễn Trãi,
                            Thanh Xuân <span>Hà Nội.</span></li>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email : <a
                                    href="mailto:shoptat@gmail.com">shoptat@gmail.com</a></li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>Phone : 01672923739</li>
                    </ul>
                </section>
                <section class="col-md-4 sign-gd-two">
                    <div class="fb-page" data-href="https://www.facebook.com/facebook" d data-width="380"
                         data-hide-cover="false"
                         data-show-facepile="false">
                        <blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com/facebook">Facebook</a></blockquote>
                    </div>
                    <div id="fb-root"></div>
                    <script>(function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12';
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                </section>
                <section class="clearfix"></section>
            </section>
        </section>
        <section class="clearfix"></section>
        <a class="btn-top" href="javascript:void(0);" title="Top" style="display: inline;"></a>
    </section>
<?php } ?>

<?php function login()
{ ?>
    <?php
    if (isset($_POST['signin'])) {
        $tendangnhaplogin = addslashes($_POST['tendangnhaplogin']);
        $matkhaulogin = md5(addslashes($_POST['matkhaulogin']));
        $sql = "select*from thanhvien where tendangnhap='$tendangnhaplogin' and matkhau='$matkhaulogin'";
        GLOBAL $connect;
        $kq = $connect->query($sql);
        if (mysqli_num_rows($kq) == 0)
            $UserError = "Sai tên đăng nhập hoặc mật khẩu!";
        else {
            $rowthanhvien = mysqli_fetch_array($kq);
            if ($rowthanhvien['trangthai'] == 0)
                $UserError = "Tài khoản của bạn đang bị tạm khóa!";
            else {
                $_SESSION['tendangnhap'] = $tendangnhaplogin;
                if (isset($_GET['order']))
                    header("Location: .?dieuhuong=order");
                else
                    echo "<script>alert('Đăng nhập thành công!');location='.';</script>";
            }
        }
    }
    ?>
    <?php
    if (isset($_POST['signup'])) {
        $tendangnhap = addslashes($_POST['tendangnhap']);
        $matkhau = addslashes($_POST['matkhau']);
        $hoten = addslashes($_POST['hoten']);
        $diachi = addslashes($_POST['diachi']);
        $dienthoai = addslashes($_POST['phone']);
        $email = addslashes($_POST['email']);
        $sql = "select*from thanhvien where tendangnhap='$tendangnhap'";
        GLOBAL $connect;
        $kq = $connect->query($sql);
        if (mysqli_num_rows($kq) > 0) {
            $UserError1 = "Tên đăng nhập đã tồn tại";
        } else {
            $sql = "select*from thanhvien where email='$email'";
            GLOBAL $connect;
            $kq = $connect->query($sql);
            if (mysqli_num_rows($kq) > 0) {
                $EmailrError1 = "Email đã tồn tại";
            } else {
                $sql = "select*from thanhvien where dienthoai='$dienthoai'";
                GLOBAL $connect;
                $kq = $connect->query($sql);
                if (mysqli_num_rows($kq) > 0) {
                    $DienThoaiError1 = "Số điện thoại đã được đăng ký";
                } else {
                    $matkhau = md5($matkhau);
                    $sql = "insert thanhvien(tendangnhap,matkhau,hoten,dienthoai,diachi,email,ngaytao) values('$tendangnhap','$matkhau','$hoten','$dienthoai','$diachi','$email',now())";
                    GLOBAL $connect;
                    $connect->query($sql) or die("Không đăng ký được");
                    if (isset($_GET['order']))
                        header("Location: .?dieuhuong=login&order=1");
                    else
                        echo "<script>alert('Chúc mừng bạn đăng ký thành công.'); location='.';</script>";
                }
            }
        }
    }
    ?>
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Đăng nhập - Đăng ký</li>
        </ol>
    </section>
    <!-- contact -->
    <section class="contact">
        <section class="container">
            <section class="login-grids">
                <section class="login">
                    <section class="login-right">
                        <h3><span class="glyphicon glyphicon-user"></span> Đăng nhập</h3>
                        <form method="post" id="signinForm">
                            <section class="sign-in">
                                <h4>Tên đăng nhập :</h4>
                                <input type="text" name="tendangnhaplogin" placeholder="Mời nhập tên đăng nhập"
                                       value="<?php if (isset($tendangnhaplogin)) echo $tendangnhaplogin; ?>">
                            </section>
                            <section class="sign-in">
                                <h4>Mật khẩu :</h4>
                                <input type="password" name="matkhaulogin" placeholder="Mời nhập mật khẩu"
                                       value="<?php if (isset($_POST['matkhaulogin'])) echo $_POST['matkhaulogin']; ?>">
                            </section>
                            <section class="sign-in">
                                <em id="login-error"
                                    class="error help-block"><?php if (isset($UserError)) echo $UserError; ?></em>
                                <input type="submit" name="signin" value="ĐĂNG NHẬP">
                            </section>
                        </form>
                    </section>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $("#signinForm").validate({
                                rules: {
                                    tendangnhaplogin: "required",
                                    matkhaulogin: "required",
                                },
                                messages: {
                                    tendangnhaplogin: "Tên đăng nhập không được để trống",
                                    matkhaulogin: "Mật khẩu không được để trống"
                                },
                                errorElement: "em",
                                errorPlacement: function (error, element) {
                                    // Add the `help-block` class to the error element
                                    error.addClass("help-block");

                                    if (element.prop("type") === "checkbox") {
                                        error.insertAfter(element.parent("label"));
                                    } else {
                                        error.insertAfter(element);
                                    }
                                },
                                highlight: function (element, errorClass, validClass) {
                                    $(element).parents(".col-sm-12").addClass("has-error").removeClass("has-success");
                                },
                                unhighlight: function (element, errorClass, validClass) {
                                    $(element).parents(".col-sm-12").addClass("has-success").removeClass("has-error");
                                }
                            });
                        });
                    </script>
                    <section class="login-bottom">
                        <h3><span class="glyphicon glyphicon-user"></span> Đăng ký</h3>
                        <form method="post" id="signupForm">
                            <section class="sign-up">
                                <h4>Họ tên :</h4>
                                <input type="text" name="hoten" id="hoten"
                                       value="<?php if (isset($hoten)) echo $hoten ?>" placeholder="Mời nhập họ tên">
                            </section>
                            <section class="sign-up">
                                <h4>Tên đăng nhập :</h4>
                                <input type="text" name="tendangnhap" id="tendangnhap"
                                       value="<?php if (isset($tendangnhap)) echo $tendangnhap ?>"
                                       placeholder="Mời nhập tên đăng nhập">
                                <em id="login-error"
                                    class="error help-block"><?php if (isset($UserError1)) echo $UserError1; ?></em>
                            </section>
                            <section class="sign-up">
                                <h4>Mật khẩu :</h4>
                                <input type="password" name="matkhau" id="matkhau"
                                       value="<?php if (isset($_POST['matkhau'])) echo $_POST['matkhau'] ?>"
                                       placeholder="Mời nhập mật khẩu">
                            </section>
                            <section class="sign-up">
                                <h4>Nhập lại mật khẩu :</h4>
                                <input type="password" name="rematkhau" id="rematkhau"
                                       value="<?php if (isset($_POST['rematkhau'])) echo $_POST['rematkhau'] ?>"
                                       placeholder="Mời nhập lại mật khẩu">
                            </section>
                            <section class="sign-up">
                                <h4>Điện thoại :</h4>
                                <input type="text" name="phone" id="phone"
                                       value="<?php if (isset($dienthoai)) echo $dienthoai ?>"
                                       placeholder="Mời nhập điện thoại">
                                <em id="login-error"
                                    class="error help-block"><?php if (isset($DienThoaiError1)) echo $DienThoaiError1; ?></em>
                            </section>
                            <section class="sign-up">
                                <h4>Email :</h4>
                                <input type="text" name="email" id="email"
                                       value="<?php if (isset($email)) echo $email ?>" placeholder="Mời nhập email">
                                <em id="login-error"
                                    class="error help-block"><?php if (isset($EmailrError1)) echo $EmailrError1; ?></em>
                            </section>
                            <section class="sign-up">
                                <h4>Địa chỉ :</h4>
                                <input type="text" name="diachi" id="diachi" class="form-control textboxlogin"
                                       value="<?php if (isset($diachi)) echo $diachi ?>" placeholder="Mời nhập địa chỉ">
                            </section>
                            <section class="sign-up">
                                <input type="submit" value="ĐĂNG KÝ" name="signup">
                            </section>
                        </form>
                    </section>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $("#signupForm").validate({
                                rules: {
                                    tendangnhap: {
                                        required: true,
                                        rangelength: [4, 13]
                                    },
                                    matkhau: {
                                        required: true,
                                        minlength: 6,
                                    },
                                    rematkhau: {
                                        required: true,
                                        minlength: 6,
                                        equalTo: "#matkhau"
                                    },
                                    hoten: "required",
                                    phone: {
                                        required: true,
                                        minlength: 9,
                                        maxlength: 11,
                                    },
                                    email: {
                                        required: true,
                                        email: true
                                    },
                                    diachi: {
                                        required: true,
                                        minlength: 6
                                    }
                                },
                                messages: {
                                    tendangnhap: {
                                        required: "Tên đăng nhập không được để trống",
                                        rangelength: "Tên đăng nhập phải từ 4 đến 13 ký tự"
                                    },
                                    matkhau: {
                                        required: "Mật khẩu không được để trống",
                                        minlength: "Mật khẩu phải có ít nhất 6 ký tự"
                                    },
                                    rematkhau: {
                                        required: "Nhập lại mật khẩu không được để trống",
                                        minlength: "Nhập lại mật khẩu phải có ít nhất 6 ký tự",
                                        equalTo: "Nhập lại mật khẩu và mật khẩu không khớp nhau"
                                    },
                                    hoten: "Họ tên không được để trống",
                                    phone: {
                                        required: "Điện thoại không được để trống",
                                        minlength: "Điện thoại có ít nhất 9 số",
                                        maxlength: "Điện thoại có nhiều nhất 11 số",
                                    },
                                    email: {
                                        required: "Email không được để trống",
                                        email: "Email không đúng định dạng"
                                    },
                                    diachi: {
                                        required: "Địa chỉ không được để trống",
                                        minlength: "Địa chỉ quá ngắn"
                                    }
                                },
                                errorElement: "em",
                                errorPlacement: function (error, element) {
                                    // Add the `help-block` class to the error element
                                    error.addClass("help-block");

                                    if (element.prop("type") === "checkbox") {
                                        error.insertAfter(element.parent("label"));
                                    } else {
                                        error.insertAfter(element);
                                    }
                                },
                                highlight: function (element, errorClass, validClass) {
                                    $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                                },
                                unhighlight: function (element, errorClass, validClass) {
                                    $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                                }
                            });
                        });
                    </script>
                    <section class="clearfix"></section>
                </section>
            </section>
        </section>
    </section>
<?php } ?>

<?php function chitiet()
{ ?>
    <?php
    if (isset($_POST['dathangsp'])) {
        $soluong = $_POST['soluong'];
        $mau = $_POST['mau'];
        $size = $_POST['size'];
        $masp = $_GET['masanpham'];
        $sql = "select mau.tenmau,size.tensize,chitietsanpham.trangthai,chitietsanpham.machitiet from chitietsanpham,mau,size where size.masize=chitietsanpham.masize and mau.mamau=chitietsanpham.mamau and chitietsanpham.mamau='$mau' and chitietsanpham.masize='$size' and chitietsanpham.masp='$masp'";
        GLOBAL $connect;
        $kq22 = $connect->query($sql);
        $rowchitiet = mysqli_fetch_array($kq22);
        $tenmau = $rowchitiet['tenmau'];
        $tensize = $rowchitiet['tensize'];
        if ($rowchitiet['trangthai'] == 1) {
            $machitiet = $rowchitiet['machitiet'];
            echo "<script>location='?dieuhuong=cart&hanhdong=addtocart&machitiet=$machitiet&soluong=$soluong';</script>";
        } else {
            $erros = "Không còn sản phẩm có màu: $tenmau và size: $tensize";

        }
    }
    ?>
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <?php
    if (isset($_GET['masanpham'])) {
        $masanpham = $_GET['masanpham'];
        $sql = "select*from sanpham where masanpham='$masanpham'";
        GLOBAL $connect;
        $kq = $connect->query($sql);
        $rowsanpham = mysqli_fetch_array($kq);
        ?>
        <section class="container">
            <ol class="breadcrumb">
                <?php
                $sql = "select*from nhomsp where manhom=" . $rowsanpham['manhomsp'];
                GLOBAL $connect;
                $kq1 = $connect->query($sql);
                $rownhom = mysqli_fetch_array($kq1);
                $sql = "select*from loaisp where maloai=" . $rowsanpham['maloaisp'];
                GLOBAL $connect;
                $kq2 = $connect->query($sql);
                $rowloai = mysqli_fetch_array($kq2);
                ?>
                <li><a href="?dieuhuong=home">Home</a></li>
                <li><a href="?dieuhuong=dssanpham&manhom=<?= $rownhom['manhom'] ?>"><?= $rownhom['tennhom'] ?></a></li>
                <li><a href="?dieuhuong=dssanpham&maloai=<?= $rowloai['maloai'] ?>"><?= $rowloai['tenloai'] ?></a></li>
                <li class="active"><?= $rowsanpham['tensanpham'] ?></li>
            </ol>
        </section>
        <section class="single">
            <section class="container">
                <section class="col-md-6 col-sm-12 single-right-left animated wow slideInUp animated"
                         data-wow-delay=".5s"
                         style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
                    <section class="grid images_3_of_2">
                        <section class="flexslider">
                            <!-- FlexSlider -->
                            <script>
                                // Can also be used with $(document).ready()
                                $(window).load(function () {
                                    $('.flexslider').flexslider({
                                        animation: "slide",
                                        controlNav: "thumbnails",
                                    });
                                });
                            </script>
                            <!-- //FlexSlider-->
                            <ul class="slides">
                                <?php
                                $sql = "select*from anhsp where trangthaianh=1 and masp='$masanpham' limit 4";
                                GLOBAL $connect;
                                $kq3 = $connect->query($sql);
                                if (mysqli_num_rows($kq3) > 0) {
                                    while ($rowanhsp = mysqli_fetch_array($kq3)) {
                                        ?>
                                        <li data-thumb="images/<?= $rowanhsp['duongdan'] ?>">
                                            <img src="images/<?= $rowanhsp['duongdan'] ?>" data-imagezoom="true"
                                                 class="img-responsive" style="margin-left: auto; margin-right: auto;">
                                        </li>
                                    <?php }
                                } else {
                                    ?>
                                    <li data-thumb="images/<?= $rowsanpham['anhdaidien'] ?>">
                                        <img src="images/<?= $rowsanpham['anhdaidien'] ?>" data-imagezoom="true"
                                             class="img-responsive" style="margin-left: auto; margin-right: auto;">
                                    </li>
                                <?php } ?>
                            </ul>
                            <section class="clearfix"></section>
                        </section>
                    </section>
                </section>
                <section
                        class="col-md-6 col-sm-12 single-right-left simpleCart_shelfItem animated wow slideInRight animated"
                        data-wow-delay=".5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight; padding-left: 20px">
                    <h3><?= $rowsanpham['tensanpham'] ?></h3>
                    <p><span class="item_price">Giá cũ:<del><?= number_format($rowsanpham['gia'], 0, ',', '.') ?>đ</del></span>
                    </p>
                    <?php $giamoi = $rowsanpham['gia'] * (100 - $rowsanpham['khuyenmai']) / 100; ?>
                    <p><span class="item_price">Giá ưu đãi: <span
                                    style="color: red; font-weight: bolder; font-size: 26px"><?= number_format($giamoi, 0, ',', '.') ?>
                                đ</span></span></p>
                    <form action="" id="addsp" method="post">
                        <section class="color-quality" style="margin-bottom: 0.8em;">
                            <section class="color-quality-right">
                                <h5>Size :</h5>
                                <select id="country1" name="size">
                                    <option value="" hidden=""> Mời chọn size</option>
                                    <?php
                                    $sql = "select distinct chitietsanpham.masize,tensize from chitietsanpham,size where chitietsanpham.masize=size.masize and masp='$masanpham' and chitietsanpham.trangthai=1";
                                    GLOBAL $connect;
                                    $kq4 = $connect->query($sql);
                                    while ($rowchitietsize = mysqli_fetch_array($kq4)) {
                                        ?>
                                        <option value="<?= $rowchitietsize['masize'] ?>"><?= $rowchitietsize['tensize'] ?></option>
                                    <?php } ?>
                                </select>
                            </section>
                        </section>
                        <section class="color-quality">
                            <section class="color-quality-right">
                                <h5>Màu :</h5>
                                <select id="country1" name="mau">
                                    <option value="" hidden=""> Mời chọn màu</option>
                                    <?php
                                    $sql = "select distinct chitietsanpham.mamau,tenmau from chitietsanpham,mau where chitietsanpham.mamau=mau.mamau and masp='$masanpham' and chitietsanpham.trangthai=1";
                                    GLOBAL $connect;
                                    $kq5 = $connect->query($sql);
                                    while ($rowchitietmau = mysqli_fetch_array($kq5)) {
                                        ?>
                                        <option value="<?= $rowchitietmau['mamau'] ?>"><?= $rowchitietmau['tenmau'] ?></option>
                                    <?php } ?>
                                </select>
                            </section>
                        </section>
                        <section class="color-quality" style="margin:10px 0;">
                            <section class="color-quality-right">
                                <h5>Số lượng :</h5>
                                <input type="number" name="soluong" value="1" style="padding: 5px 0px 5px 21px">
                            </section>
                        </section>
                        <section class="occasion-cart" style="margin-top: 10px">
                            <span id="tenloai1-error"
                                  class="error help-block"><?php if (isset($erros)) echo $erros ?></span>
                            <input type="submit" name="dathangsp" class="btn btn-info"
                                   class="item hvr-outline-out button2" value="Thêm vào giỏ hàng">
                        </section>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#addsp").validate({
                                    rules: {
                                        size: "required",
                                        mau: "required",
                                    },
                                    messages: {
                                        size: "Size sản phẩm chưa được chọn",
                                        mau: "mau sản phẩm chưa được chọn",
                                    },
                                    errorElement: "em",
                                    errorPlacement: function (error, element) {
                                        // Add the `help-block` class to the error element
                                        error.addClass("help-block");

                                        if (element.prop("type") === "checkbox") {
                                            error.insertAfter(element.parent("label"));
                                        } else {
                                            error.insertAfter(element);
                                        }
                                    },
                                    highlight: function (element, errorClass, validClass) {
                                        $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                                    },
                                    unhighlight: function (element, errorClass, validClass) {
                                        $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                                    }
                                });
                            });
                        </script>
                    </form>
                </section>
                <section class="clearfix"></section>

                <section class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s"
                         style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
                    <section class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab"
                                                                      data-toggle="tab" aria-controls="home"
                                                                      aria-expanded="true">Chi tiết</a></li>
                            <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab"
                                                       aria-controls="profile">Bình luận</a></li>
                        </ul>
                        <section id="myTabContent" class="tab-content">
                            <section role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home"
                                     aria-labelledby="home-tab">
                                <?= $rowsanpham['motasp'] ?>
                            </section>
                            <section role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile"
                                     aria-labelledby="profile-tab">
                                <section class="bootstrap-tab-text-grids">
                                    <?php
                                    $sql = "select thanhvien.hoten,binhluan.noidung,binhluan.ngaygui from binhluan,thanhvien where binhluan.mathanhvien=thanhvien.mathanhvien and binhluan.trangthai=1 and binhluan.masp='$masanpham'";
                                    GLOBAL $connect;
                                    $kq6 = $connect->query($sql);
                                    while ($rowbinhluan = mysqli_fetch_array($kq6)) {
                                        ?>
                                        <section class="bootstrap-tab-text-grid">
                                            <section class="bootstrap-tab-text-grid-right alert alert-info">
                                                <ul>
                                                    <li><a href="#"><?= $rowbinhluan['hoten'] ?></a></li>
                                                    <li><span class="fa fa-calendar"
                                                              aria-hidden="true"></span> <?php echo date("d/m/Y", strtotime($rowbinhluan['ngaygui'])) ?>
                                                    </li>
                                                </ul>
                                                <p><?= $rowbinhluan['noidung'] ?></p>
                                            </section>
                                            <section class="clearfix"></section>
                                        </section>
                                    <?php } ?>
                                    <?php
                                    if (isset($_SESSION['tendangnhap'])) {
                                        $sql = "select*from thanhvien where tendangnhap='" . $_SESSION['tendangnhap'] . "'";
                                        $kq7 = $connect->query($sql);
                                        $rowthanhvien = mysqli_fetch_array($kq7);
                                        ?>
                                        <section class="add-review">
                                            <h4>Bình luận</h4>
                                            <form method="post" id="formbinhluan">
                                                <textarea type="text" name="noidungbinhluan" id="noidungbinhluan"
                                                          rows="3"></textarea>
                                                <input type="submit" name="guibinhluan" value="Gửi">
                                            </form>
                                        </section>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#formbinhluan").validate({
                                                    rules: {
                                                        noidungbinhluan: "required",
                                                    },
                                                    messages: {
                                                        noidungbinhluan: "Nội dung bình luận không được để trống",
                                                    },
                                                    errorElement: "em",
                                                    errorPlacement: function (error, element) {
                                                        // Add the `help-block` class to the error element
                                                        error.addClass("help-block");

                                                        if (element.prop("type") === "checkbox") {
                                                            error.insertAfter(element.parent("label"));
                                                        } else {
                                                            error.insertAfter(element);
                                                        }
                                                    },
                                                    highlight: function (element, errorClass, validClass) {
                                                        $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                                                    },
                                                    unhighlight: function (element, errorClass, validClass) {
                                                        $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                                                    }
                                                });
                                            });
                                        </script>
                                        <?php
                                        if (isset($_POST['guibinhluan'])) {
                                            $noidung = addslashes($_POST['noidungbinhluan']);
                                            $mathanhvien = $rowthanhvien['mathanhvien'];
                                            $sql = "insert binhluan(noidung,mathanhvien,masp,ngaygui) values('$noidung','$mathanhvien','$masanpham',now())";
                                            GLOBAL $connect;
                                            $connect->query($sql) or die("Không chèn được");
                                            echo "<script>alert('Thêm bình luận thành công.'); location='?dieuhuong=chitiet&masanpham=$masanpham';</script>";
                                        }
                                    }
                                    ?>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    <?php } ?>
<?php } ?>

<?php function dssanpham()
{ ?>
    <!-- banner -->
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb" style="margin-bottom: 0px">
            <li><a href="?dieuhuong=home">Home</a></li>
            <?php
            if (isset($_GET['manhom'])) {
                $sql = "select*from nhomsp where manhom=" . $_GET['manhom'];
                GLOBAL $connect;
                $kq11 = $connect->query($sql);
                $rownhomsp = mysqli_fetch_array($kq11);
                ?>
                <li class="active"><?= $rownhomsp['tennhom'] ?></li>
            <?php } ?>
            <?php
            if (isset($_GET['maloai'])) {
                $sql = "select*from loaisp where maloai=" . $_GET['maloai'];
                GLOBAL $connect;
                $kq12 = $connect->query($sql);
                $rowloaisp = mysqli_fetch_array($kq12);
                $sql = "select*from nhomsp where manhom=" . $rowloaisp['manhomsp'];
                GLOBAL $connect;
                $kq13 = $connect->query($sql);
                $rownhomsp = mysqli_fetch_array($kq13);
                ?>
                <li><a href="?dieuhuong=dssanpham&manhom=<?= $rownhomsp['manhom'] ?>"><?= $rownhomsp['tennhom'] ?></a>
                </li>
                <li class="active"><?= $rowloaisp['tenloai'] ?></li>
            <?php } ?>
        </ol>
    </section>
    <section class="men-wear">
        <section class="container">
            <section class="col-md-12 products-right">
                <section class="col-md-12 sort-grid">
                    <section class="col-md-4 col-sm-6 col-xs-12">
                        <section class="form-group input-group">
                            <span class="input-group-addon">Mức giá:</span>
                            <select class="form-control" name="gia"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <?php
                                $url = 'dieuhuong=dssanpham';
                                if (isset($_GET['manhom'])) {
                                    $url .= '&manhom=' . $_GET['manhom'];
                                }
                                if (isset($_GET['maloai'])) {
                                    $url .= '&maloai=' . $_GET['maloai'];
                                }
                                ?>
                                <option value="?<?= $url ?>" selected>Xem tất cả</option>
                                <?php
                                $sql = "select*from mucgia where trangthaimucgia=1";
                                GLOBAL $connect;
                                $kq10 = $connect->query($sql);
                                while ($rowmucgia = mysqli_fetch_array($kq10)) {
                                    if (isset($_GET['mucthap']) and $_GET['mucthap'] == $rowmucgia['mucthap']) {
                                        ?>
                                        <option selected
                                                value="?<?= $url ?>&mucthap=<?= $rowmucgia['mucthap'] ?>&muccao=<?= $rowmucgia['muccao'] ?>"><?= $rowmucgia['tenmucgia'] ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="?<?= $url ?>&mucthap=<?= $rowmucgia['mucthap'] ?>&muccao=<?= $rowmucgia['muccao'] ?>"><?= $rowmucgia['tenmucgia'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </section>
                    </section>
                    <section class="col-md-4 col-sm-6 col-xs-12">
                        <section class="form-group input-group">
                            <span class="input-group-addon">Sắp xếp:</span>
                            <select class="form-control" name="xep"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <?php
                                if (isset($_GET['mucthap'])) {
                                    $mucthap = $_GET['mucthap'];
                                    $muccao = $_GET['muccao'];
                                    if ($muccao != 0)
                                        $url .= '&mucthap=' . $_GET['mucthap'];
                                    else
                                        $url .= '&mucthap=' . $_GET['mucthap'];
                                    $url .= '&muccao=' . $_GET['muccao'];
                                }
                                ?>
                                <option value="" hidden="">Mời bạn lựa chọn</option>
                                <?php
                                if ($_GET['sapxep'] == 1) { ?>
                                    <option selected value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } elseif ($_GET['sapxep'] == 2) { ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option selected value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } elseif ($_GET['sapxep'] == 3) { ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option selected value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)
                                    </option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } elseif ($_GET['sapxep'] == 4) { ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option selected value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)
                                    </option>
                                <?php } else {
                                    ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } ?>
                            </select>
                        </section>
                    </section>
                    <section class="col-md-2 col-sm-6 col-xs-12">
                        <section class="form-group input-group" style="margin-bottom: 10px;">
                            <span class="input-group-addon">Hiển thị:</span>
                            <select class="form-control" name="hienthi"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <option value="" hidden="">-- Mời bạn chọn --</option>
                                <?php
                                if (isset($_GET['sapxep'])) {
                                    $url .= '&sapxep=' . $_GET['sapxep'];
                                }
                                if ($_GET['soluong'] == 12) { ?>
                                    <option value="?<?= $url ?>&soluong=12">12</option>
                                    <option selected value="?<?= $url ?>&soluong=24">24</option>
                                    <option value="?<?= $url ?>&soluong=36">36</option>
                                <?php } elseif ($_GET['soluong'] == 50) { ?>
                                    <option value="?<?= $url ?>&soluong=12">12</option>
                                    <option value="?<?= $url ?>=24">24</option>
                                    <option selected value="?<?= $url ?>=36">36</option>
                                <?php } else {
                                    ?>
                                    <option value="?<?= $url ?>&soluong=12" selected>12</option>
                                    <option value="?<?= $url ?>&soluong=24">24</option>
                                    <option value="?<?= $url ?>&soluong=36">36</option>
                                <?php } ?>
                            </select>
                        </section>
                    </section>
                    <section class="clearfix"></section>
                </section>
                <?php
                $sql = "select*from sanpham where trangthaisp=1";
                if (isset($_GET['manhom'])) {
                    $manhom = $_GET['manhom'];
                    $sql .= " and manhomsp='$manhom'";
                }
                if (isset($_GET['maloai'])) {
                    $maloai = $_GET['maloai'];
                    $sql .= " and maloaisp='$maloai'";
                }
                if (isset($_GET['mucthap'])) {
                    $mucthap = $_GET['mucthap'];
                    $muccao = $_GET['muccao'];
                    if ($muccao != 0)
                        $sql .= " and gia>='$mucthap' and gia<'$muccao'";
                    else
                        $sql .= " and gia>='$mucthap'";
                }
                if (isset($_GET['sapxep']) and $_GET['sapxep'] == 1) {
                    $sql .= " order by tensanpham asc";
                } elseif (isset($_GET['sapxep']) and $_GET['sapxep'] == 2) {
                    $sql .= " order by tensanpham desc";
                } elseif (isset($_GET['sapxep']) and $_GET['sapxep'] == 3) {
                    $sql .= " order by gia desc";
                } else {
                    $sql .= " order by gia asc";
                }
                if (isset($_GET['soluong'])) {
                    $spmt = $_GET['soluong'];
                } else {
                    $spmt = 12;
                }
                GLOBAL $connect;
                $kq1 = $connect->query($sql);
                $tongsotrang = ceil(mysqli_num_rows($kq1) / $spmt);
                if (isset($_GET['trangso']))
                    $trangso = $_GET['trangso'];
                if (!isset($trangso) || $trangso > $tongsotrang || $trangso <= 0) {
                    $trangso = 1;
                }
                $from = ($trangso - 1) * $spmt;
                $sql .= " limit $from,$spmt";
                GLOBAL $connect;
                $kq2 = $connect->query($sql);
                if (mysqli_num_rows($kq2) == 0) {
                    ?>
                    <section class="col-lg-12"
                             style="text-align: center; font-size: 20px; color: #03a9f4; font-weight: bolder;">
                        Không tìm thấy sản phẩm phù hợp yêu cầu
                    </section>
                    <?php
                } else
                    while ($rowsanpham = mysqli_fetch_array($kq2)) {
                        ?>
                        <section class="col-md-3 product-men" id="product-men-img">
                            <section class="men-pro-item simpleCart_shelfItem">
                                <section class="men-thumb-item">
                                    <img src="images/<?= $rowsanpham['anhdaidien'] ?>" alt=""
                                         title="<?= $rowsanpham['tensanpham'] ?>" class="pro-image-front">
                                    <img src="images/<?= $rowsanpham['anhdaidien'] ?>" alt=""
                                         title="<?= $rowsanpham['tensanpham'] ?>" class="pro-image-back">
                                    <section class="men-cart-pro">
                                        <section class="inner-men-cart-pro">
                                            <a href="?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>"
                                               class="link-product-add-cart">Xem nhanh</a>
                                        </section>
                                    </section>
                                </section>
                                <section class="item-info-product ">
                                    <section class="info-product-price">
                                        <span class="item_price">Giá: <?= number_format($rowsanpham['gia'], 0, ',', '.') ?>
                                            đ</span>
                                    </section>
                                    <a href="#" class="item single-item hvr-outline-out button2"
                                       onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>';"><i
                                                class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> Thêm
                                        giỏ hàng</a>
                                </section>
                            </section>
                        </section>
                        <?php
                    }
                ?>
                <section class="clearfix"></section>
            </section>
            <section class="pagination-grid text-right">
                <ul class="pagination paging">
                    <?php
                    if ($tongsotrang > 1) {
                        if (isset($_GET['soluong'])) {
                            $url .= '&soluong=' . $_GET['soluong'];
                        } ?>
                        <?php if ($trangso > 1) { ?>
                            <li><a href="?<?= $url ?>&trangso=1">Đầu</a></li>
                            <li><a href="?<?= $url ?>&trangso=<?= $trangso - 1 ?>">Trước</a></li>
                        <?php } ?>
                        <?php
                        for ($i = $trangso; $i <= $tongsotrang; $i++) {
                            if ($i <= $trangso + 2) {
                                ?>
                                <li><a href="?<?= $url ?>&trangso=<?= $i ?>"><?= $i ?></a></li>
                                <?php
                            }
                        }
                        ?>
                        <?php if ($trangso < $tongsotrang) { ?>
                            <li><a href="?<?= $url ?>&trangso=<?= $trangso + 1 ?>">Sau</a></li>
                            <li><a href="?<?= $url ?>&trangso=<?= $tongsotrang ?>">Cuối</a></li>
                        <?php }
                    } ?>
                </ul>
            </section>
        </section>
    </section>
<?php } ?>

<!--Function Search-->
<?php function search()
{ ?>
    <!-- banner -->
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb" style="margin-bottom: 0px">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Sreach</li>
        </ol>
    </section>
    <section class="men-wear">
        <section class="container">
            <section class="col-md-12 products-right">
                <section class="col-md-12 sort-grid">
                    <section class="col-md-4 col-sm-6 col-xs-12">
                        <section class="form-group input-group">
                            <span class="input-group-addon">Mức giá:</span>
                            <select class="form-control" name="gia"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <?php
                                $url = 'dieuhuong=search';
                                if (isset($_POST['tukhoa'])) {
                                    $url .= '&tukhoa=' . $_POST['tukhoa'];
                                }
                                if (isset($_GET['tukhoa'])) {
                                    $url .= '&tukhoa=' . $_GET['tukhoa'];
                                }
                                ?>
                                <option value="?<?= $url ?>" selected>Xem tất cả</option>
                                <?php
                                $sql = "select*from mucgia where trangthaimucgia=1";
                                GLOBAL $connect;
                                $kq10 = $connect->query($sql);
                                while ($rowmucgia = mysqli_fetch_array($kq10)) {
                                    if (isset($_GET['mucthap']) and $_GET['mucthap'] == $rowmucgia['mucthap']) {
                                        ?>
                                        <option selected
                                                value="?<?= $url ?>&mucthap=<?= $rowmucgia['mucthap'] ?>&muccao=<?= $rowmucgia['muccao'] ?>"><?= $rowmucgia['tenmucgia'] ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="?<?= $url ?>&mucthap=<?= $rowmucgia['mucthap'] ?>&muccao=<?= $rowmucgia['muccao'] ?>"><?= $rowmucgia['tenmucgia'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </section>
                    </section>
                    <section class="col-md-4 col-sm-6 col-xs-12">
                        <section class="form-group input-group">
                            <span class="input-group-addon">Sắp xếp:</span>
                            <select class="form-control" name="xep"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <?php
                                if (isset($_GET['mucthap'])) {
                                    $mucthap = $_GET['mucthap'];
                                    $muccao = $_GET['muccao'];
                                    if ($muccao != 0)
                                        $url .= '&mucthap=' . $_GET['mucthap'];
                                    else
                                        $url .= '&mucthap=' . $_GET['mucthap'];
                                    $url .= '&muccao=' . $_GET['muccao'];
                                }
                                ?>
                                <option value="" hidden="">Mời bạn lựa chọn</option>
                                <?php
                                if ($_GET['sapxep'] == 1) { ?>
                                    <option selected value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } elseif ($_GET['sapxep'] == 2) { ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option selected value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } elseif ($_GET['sapxep'] == 3) { ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option selected value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)
                                    </option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } elseif ($_GET['sapxep'] == 4) { ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option selected value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)
                                    </option>
                                <?php } else {
                                    ?>
                                    <option value="?<?= $url ?>&sapxep=1">Theo tên sản phẩm(Từ A-Z)</option>
                                    <option value="?<?= $url ?>&sapxep=2">Theo tên sản phẩm(Từ Z-A)</option>
                                    <option value="?<?= $url ?>&sapxep=3">Theo giá sản phẩm(Từ cao-thấp)</option>
                                    <option value="?<?= $url ?>&sapxep=4">Theo giá sản phẩm(Từ thấp-cao)</option>
                                <?php } ?>
                            </select>
                        </section>
                    </section>
                    <section class="col-md-2 col-sm-6 col-xs-12">
                        <section class="form-group input-group" style="margin-bottom: 10px;">
                            <span class="input-group-addon">Hiển thị:</span>
                            <select class="form-control" name="hienthi"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <option value="" hidden="">-- Mời bạn chọn --</option>
                                <?php
                                if (isset($_GET['sapxep'])) {
                                    $url .= '&sapxep=' . $_GET['sapxep'];
                                }
                                if ($_GET['soluong'] == 12) { ?>
                                    <option value="?<?= $url ?>&soluong=12">12</option>
                                    <option selected value="?<?= $url ?>&soluong=24">24</option>
                                    <option value="?<?= $url ?>&soluong=36">36</option>
                                <?php } elseif ($_GET['soluong'] == 50) { ?>
                                    <option value="?<?= $url ?>&soluong=12">12</option>
                                    <option value="?<?= $url ?>=24">24</option>
                                    <option selected value="?<?= $url ?>=36">36</option>
                                <?php } else {
                                    ?>
                                    <option value="?<?= $url ?>&soluong=12" selected>12</option>
                                    <option value="?<?= $url ?>&soluong=24">24</option>
                                    <option value="?<?= $url ?>&soluong=36">36</option>
                                <?php } ?>
                            </select>
                        </section>
                    </section>
                </section>
                <?php
                if (isset($_POST['tukhoa'])) {
                    $tukhoa = $_POST['tukhoa'];
                }
                if (isset($_GET['tukhoa'])) {
                    $tukhoa = $_GET['tukhoa'];
                }
                $sql = "select*from sanpham where trangthaisp=1 and tensanpham like '%$tukhoa%'";
                if (isset($_GET['manhom'])) {
                    $manhom = $_GET['manhom'];
                    $sql .= " and manhomsp='$manhom'";
                }
                if (isset($_GET['maloai'])) {
                    $maloai = $_GET['maloai'];
                    $sql .= " and maloaisp='$maloai'";
                }
                if (isset($_GET['mucthap'])) {
                    $mucthap = $_GET['mucthap'];
                    $muccao = $_GET['muccao'];
                    if ($muccao != 0)
                        $sql .= " and gia>='$mucthap' and gia<'$muccao'";
                    else
                        $sql .= " and gia>='$mucthap'";
                }
                if (isset($_GET['sapxep']) and $_GET['sapxep'] == 1) {
                    $sql .= " order by tensanpham asc";
                } elseif (isset($_GET['sapxep']) and $_GET['sapxep'] == 2) {
                    $sql .= " order by tensanpham desc";
                } elseif (isset($_GET['sapxep']) and $_GET['sapxep'] == 3) {
                    $sql .= " order by gia desc";
                } else {
                    $sql .= " order by gia asc";
                }
                if (isset($_GET['soluong'])) {
                    $spmt = $_GET['soluong'];
                } else {
                    $spmt = 12;
                }
                GLOBAL $connect;
                $kq1 = $connect->query($sql);
                $tongsotrang = ceil(mysqli_num_rows($kq1) / $spmt);
                if (isset($_GET['trangso']))
                    $trangso = $_GET['trangso'];
                if (!isset($trangso) || $trangso > $tongsotrang || $trangso <= 0) {
                    $trangso = 1;
                }
                $from = ($trangso - 1) * $spmt;
                $sql .= " limit $from,$spmt";
                GLOBAL $connect;
                $kq2 = $connect->query($sql);
                if (mysqli_num_rows($kq2) == 0) {
                    ?>
                    <section class="col-lg-12"
                             style="text-align: center; font-size: 20px; color: #03a9f4; font-weight: bolder;">
                        Không tìm thấy sản phẩm phù hợp yêu cầu
                    </section>
                    <?php
                } else
                    while ($rowsanpham = mysqli_fetch_array($kq2)) {
                        ?>
                        <section class="col-md-3 product-men" id="product-men-img">
                            <section class="men-pro-item simpleCart_shelfItem">
                                <section class="men-thumb-item">
                                    <img src="images/<?= $rowsanpham['anhdaidien'] ?>" alt=""
                                         title="<?= $rowsanpham['tensanpham'] ?>" class="pro-image-front">
                                    <img src="images/<?= $rowsanpham['anhdaidien'] ?>" alt=""
                                         title="<?= $rowsanpham['tensanpham'] ?>" class="pro-image-back">
                                    <section class="men-cart-pro">
                                        <section class="inner-men-cart-pro">
                                            <a href="?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>"
                                               class="link-product-add-cart">Xem nhanh</a>
                                        </section>
                                    </section>
                                </section>
                                <section class="item-info-product ">
                                    <section class="info-product-price">
                                        <span class="item_price">Giá: <?= number_format($rowsanpham['gia'], 0, ',', '.') ?>
                                            đ</span>
                                    </section>
                                    <a href="#" class="item single-item hvr-outline-out button2"
                                       onClick="location='?dieuhuong=chitiet&masanpham=<?= $rowsanpham['masanpham'] ?>';"><i
                                                class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> Đặt
                                        hàng</a>
                                </section>
                            </section>
                        </section>
                        <?php
                    }
                ?>
                <section class="clearfix"></section>
            </section>
            <section class="pagination-grid text-right">
                <ul class="pagination paging">
                    <?php
                    if ($tongsotrang > 1) {
                        if (isset($_GET['soluong'])) {
                            $url .= '&soluong=' . $_GET['soluong'];
                        } ?>
                        <?php if ($trangso > 1) { ?>
                            <li><a href="?<?= $url ?>&trangso=1">Đầu</a></li>
                            <li><a href="?<?= $url ?>&trangso=<?= $trangso - 1 ?>">Trước</a></li>
                        <?php } ?>
                        <?php
                        for ($i = $trangso; $i <= $tongsotrang; $i++) {
                            if ($i <= $trangso + 2) {
                                ?>
                                <li><a href="?<?= $url ?>&trangso=<?= $i ?>"><?= $i ?></a></li>
                                <?php
                            }
                        }
                        ?>
                        <?php if ($trangso < $tongsotrang) { ?>
                            <li><a href="?<?= $url ?>&trangso=<?= $trangso + 1 ?>">Sau</a></li>
                            <li><a href="?<?= $url ?>&trangso=<?= $tongsotrang ?>">Cuối</a></li>
                        <?php }
                    } ?>
                </ul>
            </section>
        </section>
    </section>
    <!-- //mens -->
<?php } ?>
<?php function order()
{ ?>
    <?php
    $sql = "select*from thanhvien where tendangnhap='" . $_SESSION['tendangnhap'] . "'";
    GLOBAL $connect;
    $kq = $connect->query($sql);
    $rowthanhvien = mysqli_fetch_array($kq);
    ?>
    <?php
    if (isset($_POST['order'])) {
        $hotennn = $_POST['hotennguoinhan'];
        $diachinn = $_POST['diachinguoinhan'];
        $dienthoainn = $_POST['dienthoainguoinhan'];
        $emailnn = $_POST['emailnguoinhan'];
        $thanhtoan = $_POST['thanhtoan'];
        $vanchuyen = $_POST['vanchuyen'];
        $mathanhvien = $rowthanhvien['mathanhvien'];
        if (isset($_POST['ghichu'])) {
            $ghichu = $_POST['ghichu'];
            $sql = "insert hoadon(mathanhvien,hotennn,diachinn,dienthoainn,emailnn,mathanhtoan,mavanchuyen,ghichu,ngaytao) values('$mathanhvien','$hotennn','$diachinn','$dienthoainn','$emailnn','$thanhtoan','$vanchuyen','$ghichu',now())";
            GLOBAL $connect;
            $connect->query($sql) or die($connect->error);
            $mahoadon = mysqli_insert_id($connect);
        } else {
            $sql = "insert hoadon(mathanhvien,hotennn,diachinn,dienthoainn,emailnn,$manthanhtoan,$mavanchuyen,ngaytao) values('$mathanhvien','$hotennn','$diachinn','$dienthoainn','$emailnn','$thanhtoan','$vanchuyen',now())";
            GLOBAL $connect;
            $connect->query($sql) or die($connect->error);
            $mahoadon = mysqli_insert_id($connect);
        }
        foreach (array_keys($_SESSION['CART']) as $machitiet) {
            $soluongmua = $_SESSION['CART'][$machitiet];
            $sql = "select chitietsanpham.masp,sanpham.gia,sanpham.khuyenmai from chitietsanpham,sanpham where sanpham.masanpham=chitietsanpham.masp and  machitiet='$machitiet'";
            GLOBAL $connect;
            $kq = $connect->query($sql);
            $rowsanpham = mysqli_fetch_array($kq);
            $gialucmua = $rowsanpham['gia'] * (100 - $rowsanpham['khuyenmai']) / 100;
            $sql = "insert chitiethoadon values('$mahoadon','$machitiet','$soluongmua','$gialucmua')";
            GLOBAL $connect;
            $connect->query($sql);
        }
        unset($_SESSION['CART']);
        echo "<script>alert('Đặt hàng thành công. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất'); location='.';</script>";
    }
    ?>
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Thanh Toán</li>
        </ol>
    </section>
    <!-- contact -->
    <section class="contact">
        <section class="container">
            <section class="login-grids">
                <h2>Thông tin thanh toán</h2>
                <form method="post" id="orderForm">
                    <section class="login">
                        <section class="login-right">
                            <h3><span class="glyphicon glyphicon-user"></span> Thông tin người đặt</h3>
                            <section class="sign-in">
                                <h4>Họ tên người đặt :</h4>
                                <input type="text" class="order-c" name="tennguoidat"
                                       value="<?= $rowthanhvien['hoten'] ?>" disabled>
                            </section>
                            <section class="sign-in">
                                <h4>Địa chỉ người đặt :</h4>
                                <input type="text" class="order-c" name="diachinguoidat"
                                       value="<?= $rowthanhvien['diachi'] ?>" disabled>
                            </section>
                            <section class="sign-in">
                                <h4>Điện thoại người đặt :</h4>
                                <input type="text" class="order-c" name="dienthoainguoidat"
                                       value="<?= $rowthanhvien['dienthoai'] ?>" disabled>
                            </section>
                            <section class="sign-in">
                                <h4>Email người đặt :</h4>
                                <input type="text" class="order-c" name="emailnguoidat"
                                       value="<?= $rowthanhvien['email'] ?>" disabled>
                            </section>
                        </section>
                        <section class="login-bottom">
                            <h3><span class="glyphicon glyphicon-user"></span> Thông tin người nhận</h3>
                            <section class="sign-up">
                                <h4>Họ tên người nhận :</h4>
                                <input type="text" name="hotennguoinhan" id="hoten"
                                       placeholder="Mời nhập họ tên người nhận" value="<?= $rowthanhvien['hoten'] ?>">
                            </section>
                            <section class="sign-up">
                                <h4>Địa chỉ người nhận :</h4>
                                <input type="text" name="diachinguoinhan" id="diachi"
                                       placeholder="Mời nhập địa chỉ người nhận chính xác"
                                       value="<?= $rowthanhvien['diachi'] ?>">
                            </section>
                            <section class="sign-up">
                                <h4>Điện thoại người nhận :</h4>
                                <input type="tel" name="dienthoainguoinhan" id="dienthoai"
                                       placeholder="Mời nhập điện thoại người nhận"
                                       value="<?= $rowthanhvien['dienthoai'] ?>">
                            </section>
                            <section class="sign-up">
                                <h4>Email người nhận :</h4>
                                <input type="email" name="emailnguoinhan" id="email"
                                       placeholder="Mời nhập Email người nhận" value="<?= $rowthanhvien['email'] ?>">
                            </section>
                            <section class="sign-up">
                                <h4>Ghi chú:</h4>
                                <textarea name="ghichu" id="ghichu" placeholder="Mời nhập ghi chú nếu cần"></textarea>
                            </section>
                        </section>
                        <section class="login-right">
                            <h3><span class="glyphicon glyphicon-user"></span> Phương thức thanh toán</h3>
                            <section class="sign-up">
                                <h4>Phương thức thanh toán :</h4>
                                <select name="thanhtoan" class="thanhtoan">
                                    <option value="" hidden>--Mời bạn lựa chọn--</option>
                                    <?php
                                    $sql = "select*from thanhtoan where trangthai=1";
                                    GLOBAL $connect;
                                    $kq1 = $connect->query($sql);
                                    while ($rowthanhtoan = mysqli_fetch_array($kq1)) {
                                        ?>
                                        <option value="<?= $rowthanhtoan['mathanhtoan'] ?>"><?= $rowthanhtoan['hinhthuctt'] ?></option>
                                    <?php } ?>
                                </select>
                            </section>
                            <section class="htthanhtoan">

                            </section>
                        </section>
                        <section class="login-bottom">
                            <h3><span class="glyphicon glyphicon-user"></span> Phương thức vận chuyển</h3>
                            <section class="sign-up">
                                <h4>Phương thức vận chuyển :</h4>
                                <select name="vanchuyen" class="vanchuyen">
                                    <option value="" hidden>--Mời bạn lựa chọn--</option>
                                    <?php
                                    $sql = "select*from vanchuyen where trangthai=1";
                                    GLOBAL $connect;
                                    $kq2 = $connect->query($sql);
                                    while ($rowvanchuyen = mysqli_fetch_array($kq2)) {
                                        ?>
                                        <option value="<?= $rowvanchuyen['mavanchuyen'] ?>"><?= $rowvanchuyen['hinhthucvc'] ?></option>
                                    <?php } ?>
                                </select>
                            </section>
                            <section class="giavc">

                            </section>
                        </section>
                        <section class="login-top">
                            <section class="submit-order">
                                <input type="submit" value="Đặt hàng" name="order">
                            </section>
                        </section>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#orderForm").validate({
                                    rules: {
                                        thanhtoan: "required",
                                        vanchuyen: "required",
                                        hotennguoinhan: "required",
                                        dienthoainguoinhan: {
                                            required: true,
                                            minlength: 9,
                                            maxlength: 11,
                                        },
                                        emailnguoinhan: {
                                            required: true,
                                            email: true
                                        },
                                        diachinguoinhan: {
                                            required: true,
                                            minlength: 6
                                        }
                                    },
                                    messages: {
                                        thanhtoan: "Phương thức thanh toán chưa được chọn",
                                        vanchuyen: "Phương thức vận chuyển chưa được chọn",
                                        hotennguoinhan: "Họ tên không được để trống",
                                        tendangnhap: {
                                            required: "Tên đăng nhập không được để trống",
                                            rangelength: "Tên đăng nhập phải từ 4 đến 13 ký tự"
                                        },
                                        dienthoainguoinhan: {
                                            required: "Điện thoại người nhận không được để trống",
                                            minlength: "Điện thoại người nhận có ít nhất 9 số",
                                            maxlength: "Điện thoại người nhận có nhiều nhất 11 số",
                                        },
                                        emailnguoinhan: {
                                            required: "Email người nhận không được để trống",
                                            email: "Email người nhận không đúng định dạng"
                                        },
                                        diachinguoinhan: {
                                            required: "Địa chỉ người nhận không được để trống",
                                            minlength: "Địa chỉ người nhận quá ngắn"
                                        }
                                    },
                                    errorElement: "em",
                                    errorPlacement: function (error, element) {
                                        // Add the `help-block` class to the error element
                                        error.addClass("help-block");

                                        if (element.prop("type") === "checkbox") {
                                            error.insertAfter(element.parent("label"));
                                        } else {
                                            error.insertAfter(element);
                                        }
                                    },
                                    highlight: function (element, errorClass, validClass) {
                                        $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                                    },
                                    unhighlight: function (element, errorClass, validClass) {
                                        $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                                    }
                                });
                            });
                        </script>
                        <section class="clearfix"></section>
                    </section>
                </form>
            </section>
        </section>
    </section>
<?php } ?>

<?php function thongtintv()
{ ?>
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Thông tin thành viên</li>
        </ol>
    </section>
    <section class="single">
        <section class="container">
            <section class="col-lg-12">
                <?php
                $sql = "select*from thanhvien where tendangnhap='" . $_SESSION['tendangnhap'] . "'";
                GLOBAL $connect;
                $kq = $connect->query($sql);
                $rowthanhvien = mysqli_fetch_array($kq);
                ?>
                <h2 class="thanhvien-h1">THÔNG TIN THÀNH VIÊN</h2>
                <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Ngày tạo tài khoản: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="tensp"
                                   value="<?php echo date('d/m/Y', strtotime($rowthanhvien['ngaytao'])) ?>" disabled>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Tên thành viên: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="tensp" value="<?= $rowthanhvien['hoten'] ?>"
                                   disabled>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Email: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="tensp" value="<?= $rowthanhvien['email'] ?>"
                                   disabled>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Điện thoại: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="tensp"
                                   value="<?= $rowthanhvien['dienthoai'] ?>" disabled>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Địa chỉ: </label>
                        <section class="col-md-10 col-sm-12">
                            <textarea class="form-control" type="text" name="noidung" id="motasp"
                                      disabled=""><?= $rowthanhvien['diachi'] ?></textarea>
                        </section>
                    </section>
                    <section class="form-group" id="b-align">
                        <section class="col-md-12 col-sm-12">
                            <input type="button" onClick="location='?dieuhuong=suathongtin';" class="btn btn-warning"
                                   value="Sửa thông tin" id="button-button">
                            <input type="button" onClick="location='?dieuhuong=doimatkhau';" class="btn btn-warning"
                                   name="themsanpham" value="Sửa mật khẩu" id="button-button">
                            <input type="button" onClick="location='?dieuhuong=xemdonhang';" class="btn btn-warning"
                                   name="xoa" value="Xem đơn hàng" id="button-button">
                        </section>
                    </section>
                </form>
            </section>
        </section>
    </section>
<?php } ?>

<?php function suathongtin()
{ ?>
    <?php
    $sql = "select*from thanhvien where tendangnhap='" . $_SESSION['tendangnhap'] . "'";
    GLOBAL $connect;
    $kq = $connect->query($sql);
    $rowthanhvien = mysqli_fetch_array($kq);
    ?>
    <?php
    if (isset($_POST['suathongtin'])) {
        $hoten = addslashes($_POST['hoten']);
        $diachi = addslashes($_POST['diachi']);
        $dienthoai = addslashes($_POST['phone']);
        $sql = "select*from thanhvien where dienthoai='$dienthoai' and tendangnhap!='" . $_SESSION['tendangnhap'] . "'";
        GLOBAL $connect;
        $kq = $connect->query($sql);
        if (mysqli_num_rows($kq) > 0) {
            $DienThoaiError1 = "Số điện thoại đã được đăng ký";
        } else {
            $sql = "update thanhvien set hoten='$hoten',diachi='$diachi',dienthoai='$dienthoai' where tendangnhap='" . $_SESSION['tendangnhap'] . "'";
            GLOBAL $connect;
            $connect->query($sql) or die("Không cập nhật được");
            echo "<script>alert('Bạn đã thay đổi thông tin thành công.'); location='?dieuhuong=ttthanhvien';</script>";
        }
    }
    ?>
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Sửa thông tin</li>
        </ol>
    </section>
    <section class="single">
        <section class="container">
            <section class="col-lg-12">
                <h2 class="thanhvien-h1">SỬA THÔNG TIN ĐĂNG KÝ</h2>
                <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Ngày tạo tài khoản: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="tensp"
                                   value="<?php echo date('d/m/Y', strtotime($rowthanhvien['ngaytao'])) ?>" disabled>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Tên thành viên: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="hoten"
                                   value="<?php if (isset($hoten)) echo $hoten; else echo $rowthanhvien['hoten'] ?>">
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Email: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="tensp" value="<?= $rowthanhvien['email'] ?>"
                                   disabled>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Điện thoại: </label>
                        <section class="col-md-10 col-sm-12">
                            <input class="form-control" type="text" name="phone"
                                   value="<?php if (isset($dienthoai)) echo $dienthoai; else echo $rowthanhvien['dienthoai'] ?>">
                            <em id="phone1-error"
                                class="error help-block"><?php if (isset($DienThoaiError1)) echo $DienThoaiError1; ?></em>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-2 col-sm-12" id="label2">Địa chỉ: </label>
                        <section class="col-md-10 col-sm-12">
                            <textarea class="form-control" type="text" name="diachi"
                                      id="diachi"><?php if (isset($diachi)) echo $diachi; else echo $rowthanhvien['diachi'] ?></textarea>
                        </section>
                    </section>
                    <section class="form-group" id="b-align">
                        <section class="col-md-12 col-sm-12">
                            <input type="button" onClick="location='?dieuhuong=ttthanhvien';" class="btn btn-warning"
                                   value="Quay lại" id="button-button">
                            <input type="submit" class="btn btn-warning" name="suathongtin" value="Thay đổi"
                                   id="button-button">
                        </section>
                    </section>
                </form>
            </section>
        </section>
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#signupForm").validate({
                rules: {
                    hoten: "required",
                    phone: {
                        required: true,
                        minlength: 9,
                        maxlength: 11,
                    },
                    diachi: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    hoten: "Họ tên không được để trống",
                    phone: {
                        required: "Điện thoại không được để trống",
                        minlength: "Điện thoại có ít nhất 9 số",
                        maxlength: "Điện thoại có nhiều nhất 11 số",
                    },
                    diachi: {
                        required: "Địa chỉ không được để trống",
                        minlength: "Địa chỉ quá ngắn"
                    }
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    // Add the `help-block` class to the error element
                    error.addClass("help-block");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                }
            });
        });
    </script>
<?php } ?>

<?php function suamatkhau()
{ ?>
    <?php
    if (isset($_POST['suamatkhau'])) {
        $matkhaucu = md5(addslashes($_POST['matkhaucu']));
        $matkhaumoi = md5(addslashes($_POST['matkhaumoi']));
        $rematkhaumoi = md5(addslashes($_POST['rematkhaumoi']));
        $sql = "select*from thanhvien where matkhau='$matkhaucu' and tendangnhap='" . $_SESSION['tendangnhap'] . "'";
        GLOBAL $connect;
        $kq = $connect->query($sql);
        if (mysqli_num_rows($kq) == 0) {
            $Matkhaucuerror = "Mật khẩu cũ không trùng khớp";
        } else {
            $sql = "update thanhvien set matkhau='$matkhaumoi' where tendangnhap='" . $_SESSION['tendangnhap'] . "'";
            GLOBAL $connect;
            $connect->query($sql) or die("Không cập nhật được");
            echo "<script>alert('Bạn đã thay đổi mật khẩu thành công.'); location='?dieuhuong=ttthanhvien';</script>";
        }
    }
    ?>
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Sửa thông tin</li>
        </ol>
    </section>
    <section class="single">
        <section class="container">
            <section class="col-lg-12">
                <h2 class="thanhvien-h1">SỬA THÔNG TIN </h2>
                <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
                    <section class="form-group">
                        <label class="control-label col-md-3 col-sm-12" id="label2">Mật khẩu cũ: </label>
                        <section class="col-md-9 col-sm-12">
                            <input class="form-control" type="password" name="matkhaucu"
                                   placeholder="Mời bạn nhập mật khẩu cũ">
                            <em id="matkhaucu1-error"
                                class="error help-block"><?php if (isset($Matkhaucuerror)) echo $Matkhaucuerror; ?></em>
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-3 col-sm-12" id="label2">Mật khẩu mới: </label>
                        <section class="col-md-9 col-sm-12">
                            <input class="form-control" type="password" name="matkhaumoi" id="matkhaumoi"
                                   placeholder="Mời bạn nhập mật khẩu mới">
                        </section>
                    </section>
                    <section class="form-group">
                        <label class="control-label col-md-3 col-sm-12" id="label2">Nhập lại mật khẩu mới: </label>
                        <section class="col-md-9 col-sm-12">
                            <input class="form-control" type="password" name="rematkhaumoi"
                                   placeholder="Mời bạn nhập lại mật khẩu mới">
                        </section>
                    </section>
                    <section class="form-group" id="b-align">
                        <section class="col-md-12 col-sm-12">
                            <input type="button" onClick="location='?dieuhuong=ttthanhvien';" class="btn btn-warning"
                                   value="Quay lại" id="button-button">
                            <input type="submit" class="btn btn-warning" name="suamatkhau" value="Sửa mật khẩu"
                                   id="button-button">
                            <input type="resert" class="btn btn-warning" value="Resert" id="button-button">
                        </section>
                    </section>
                </form>
            </section>
        </section>
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#signupForm").validate({
                rules: {
                    matkhaucu: "required",
                    matkhaumoi: {
                        required: true,
                        minlength: 6,
                    },
                    rematkhaumoi: {
                        required: true,
                        minlength: 6,
                        equalTo: "#matkhaumoi"
                    },
                },
                messages: {
                    matkhaucu: "Mật khẩu cũ không được để trống",
                    matkhaumoi: {
                        required: "Mật khẩu mới không được để trống",
                        minlength: "Mật khẩu mới phải có ít nhất 6 ký tự"
                    },
                    rematkhaumoi: {
                        required: "Nhập lại mật khẩu mới không được để trống",
                        minlength: "Nhập lại mật khẩu mới phải có ít nhất 6 ký tự",
                        equalTo: "Nhập lại mật khẩu mới và mật khẩu mới không khớp nhau"
                    },
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    // Add the `help-block` class to the error element
                    error.addClass("help-block");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                }
            });
        });
    </script>
<?php } ?>

<?php function xemdonhang()
{ ?>
    <?php
    $sql = "select*from thanhvien where tendangnhap='" . $_SESSION['tendangnhap'] . "'";
    GLOBAL $connect;
    $kq = $connect->query($sql);
    $rowthanhvien = mysqli_fetch_array($kq);
    $mathanhvien = $rowthanhvien['mathanhvien'];
    ?>

    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Xem đơn hàng</li>
        </ol>
    </section>
    <section class="single">
        <section class="container">
            <section class="col-lg-12">
                <h2 class="thanhvien-h1">DANH SÁCH ĐƠN ĐẶT HÀNG</h2>
                <form method="get" id="form_search">
                    <section class="form-inline" id="loc1">
                        <section class="form-group input-group">
                            <span class="input-group-addon">Trạng thái hóa đơn:</span>
                            <select class="form-control" name="trangthaihoadon"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <?php
                                $url = 'dieuhuong=xemdonhang';
                                if (isset($_GET['soluong'])) {
                                    $url = 'dieuhuong=xemdonhang&soluong=' . $_GET['soluong'];
                                }
                                if ($_GET['trangthaihoadon'] == 1) { ?>
                                    <option selected value="?<?= $url ?>&trangthaihoadon=1">Chưa xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=2">Đang xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=3">Đã xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
                                    <option value="?<?= $url ?>">Xem tất cả</option>
                                <?php } elseif ($_GET['trangthaihoadon'] == 2) { ?>
                                    <option value="?<?= $url ?>&trangthaihoadon=1">Chưa xử lý</option>
                                    <option selected value="?<?= $url ?>&trangthaihoadon=2">Đang xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=3">Đã xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
                                    <option value="?<?= $url ?>">Xem tất cả</option>
                                <?php } elseif ($_GET['trangthaihoadon'] == 3) { ?>
                                    <option value="?<?= $url ?>&trangthaihoadon=1">Chưa xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=2">Đang xử lý</option>
                                    <option selected value="?<?= $url ?>&trangthaihoadon=3">Đã xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
                                    <option value="?<?= $url ?>">Xem tất cả</option>
                                <?php } elseif ($_GET['trangthaihoadon'] == 4) { ?>
                                    <option value="?<?= $url ?>&trangthaihoadon=1">Chưa xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=2">Đang xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=3">Đã xử lý</option>
                                    <option selected value="?<?= $url ?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
                                    <option value="?<?= $url ?>">Xem tất cả</option>
                                <?php } else {
                                    ?>
                                    <option value="?<?= $url ?>&trangthaihoadon=1">Chưa xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=2">Đang xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon&trangthaihoadon=3">Đã xử lý</option>
                                    <option value="?<?= $url ?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
                                    <option selected value="?<?= $url ?>">Xem tất cả</option>
                                <?php }
                                ?>
                            </select>
                        </section>
                        <section class="form-group input-group">
                            <span class="input-group-addon">Hiển thị:</span>
                            <select class="form-control" name="hienthi"
                                    onChange="location=this.options[this.selectedIndex].value;">
                                <option value="" hidden="">-- Mời bạn chọn --</option>
                                <?php
                                if (isset($_GET['trangthaihoadon'])) {
                                    $url = 'dieuhuong=xemdonhang&trangthaihoadon=' . $_GET['trangthaihoadon'];
                                }
                                if ($_GET['soluong'] == 20) { ?>
                                    <option value="?<?= $url ?>&soluong=10">10</option>
                                    <option selected value="?<?= $url ?>&soluong=20">20</option>
                                    <option value="?<?= $url ?>&soluong=50">50</option>
                                <?php } elseif ($_GET['soluong'] == 50) { ?>
                                    <option value="?<?= $url ?>&soluong=10">10</option>
                                    <option value="?<?= $url ?>=20">20</option>
                                    <option selected value="?<?= $url ?>=50">50</option>
                                <?php } else {
                                    ?>
                                    <option value="?<?= $url ?>&soluong=10" selected>10</option>
                                    <option value="?<?= $url ?>&soluong=20">20</option>
                                    <option value="?<?= $url ?>&soluong=50">50</option>
                                <?php } ?>
                            </select>
                        </section>
                    </section>
                    <section class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Mã Hóa đơn</th>
                                <th>Tên người đặt</th>
                                <th>Ngày tạo</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Xem/Sửa hóa đơn</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "select hoten,hoadon.mahoadon,hoadon.hotennn,hoadon.ngaytao,hoadon.trangthaihoadon,sum(soluong*gia) as tongtien,hoadon.ngaysua,vanchuyen.giacuoc from thanhvien,hoadon,chitiethoadon,vanchuyen where thanhvien.mathanhvien=hoadon.mathanhvien and hoadon.mahoadon=chitiethoadon.mahoadon and hoadon.mavanchuyen=vanchuyen.mavanchuyen and hoadon.mathanhvien='$mathanhvien' group by hoadon.mahoadon ";
                            GLOBAL $connect;
                            if (isset($_GET['trangthaihoadon'])) {
                                $trangthaihoadon = addslashes($_GET['trangthaihoadon']);
                                $sql = "select hoten,hoadon.mahoadon,hoadon.hotennn,hoadon.ngaytao,hoadon.trangthaihoadon,sum(soluong*gia) as tongtien,hoadon.ngaysua,vanchuyen.giacuoc from thanhvien,hoadon,chitiethoadon,vanchuyen where thanhvien.mathanhvien=hoadon.mathanhvien and hoadon.mahoadon=chitiethoadon.mahoadon and hoadon.mavanchuyen=vanchuyen.mavanchuyen and trangthaihoadon='$trangthaihoadon' and hoadon.mathanhvien='$mathanhvien' group by hoadon.mahoadon ";
                            }
                            if (isset($_GET['soluong'])) {
                                $spmt = $_GET['soluong'];
                            } else {
                                $spmt = 10;
                            }
                            $sql .= "order by mahoadon desc";
                            GLOBAL $connect;
                            $kq = $connect->query($sql);
                            $tongsotrang = ceil(mysqli_num_rows($kq) / $spmt);
                            if (isset($_GET['trangso']))
                                $trangso = $_GET['trangso'];
                            if (!isset($trangso) || $trangso > $tongsotrang || $trangso <= 0) {
                                $trangso = 1;
                            }
                            $from = ($trangso - 1) * $spmt;
                            $sql .= " limit $from,$spmt";
                            GLOBAL $connect;
                            $kq1 = $connect->query($sql);
                            if (mysqli_num_rows($kq) > 0) {
                                while ($rowhoadon = mysqli_fetch_array($kq1)) {
                                    ?>
                                    <tr>
                                        <td><?= $rowhoadon['mahoadon'] ?></td>
                                        <td><?= $rowhoadon['hoten'] ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($rowhoadon['ngaytao'])) ?></td>
                                        </td>
                                        <td><?= number_format($rowhoadon['tongtien'], 0, ',', '.') ?> vnđ</td>
                                        <td><?php if ($rowhoadon['trangthaihoadon'] == 1) echo "Chưa xử lý"; elseif ($rowhoadon['trangthaihoadon'] == 2) echo "Đang xử lý"; elseif ($rowhoadon['trangthaihoadon'] == 3) echo "Đã xử lý"; else echo "Hóa đơn bị hủy"; ?></td>
                                        <td>
                                            <a href="?dieuhuong=xemchitiethd&mahoadon=<?= $rowhoadon['mahoadon'] ?>">
                                                <button type="button" class="btn btn-xs btn-primary"><span
                                                            class="fa fa-pencil"></span> Xem - Sửa
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8" id="search-pro">Không có hóa đơn nào</td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </section>
                    <section class="col-lg-12" style="text-align: center; ">
                        <ul class="pagination" style="margin-top: 0px;">
                            <?php if ($tongsotrang > 1) { ?>
                                <?php if ($trangso > 1) { ?>
                                    <li><a href="?<?= $url ?>&trangso=1">Đầu</a></li>
                                    <li><a href="?<?= $url ?>&trangso=<?= $trangso - 1 ?>">Trước</a></li>
                                <?php } ?>
                                <?php
                                for ($i = $trangso; $i <= $tongsotrang; $i++) {
                                    if ($i <= $trangso + 2) {
                                        ?>
                                        <li><a href="?<?= $url ?>&trangso=<?= $i ?>"><?= $i ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                                <?php if ($trangso < $tongsotrang) { ?>
                                    <li><a href="?<?= $url ?>&trangso=<?= $trangso + 1 ?>">Sau</a></li>
                                    <li><a href="?<?= $url ?>&trangso=<?= $tongsotrang ?>">Cuối</a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </section>
            </section>
        </section>
    </section>
<?php } ?>

<?php function xemchitiethd()
{ ?>
    <?php
    if (isset($_GET['mahoadon']))
        $mahoadon = addslashes($_GET['mahoadon']);
    ?>
    <?php
    if (isset($_POST['suahoadon'])) {
        $trangthai = addslashes($_POST['trangthai']);
        $sql = "update hoadon set trangthaihoadon='$trangthai',ngaysua=now() where mahoadon='$mahoadon'";
        GLOBAL $connect;
        $connect->query($sql) or die('Không thể cập nhật');
        $soluong = $_POST['soluong'];
        $sql = "select * from chitiethoadon where mahoadon='$mahoadon'";
        GLOBAL $connect;
        $ketqua = $connect->query($sql);
        $i = 0;
        while ($rowchitiet = mysqli_fetch_array($ketqua)) {
            $sql = "update chitiethoadon set soluong='" . $soluong[$i] . "' where mahoadon='$mahoadon' and machitietsp=" . $rowchitiet['machitietsp'];
            GLOBAL $connect;
            $connect->query($sql) or die('Không thể cập nhật');
            $i++;
        }
        echo "<script>alert('Cập nhật hóa đơn thành công!'); location='?dieuhuong=xemdonhang'</script>";
    }
    ?>
    <section class="page-head">
        <section class="container">
        </section>
    </section>
    <!-- //banner -->
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="?dieuhuong=home">Home</a></li>
            <li class="active">Xem hóa đơn</li>
        </ol>
    </section>
    <section class="single">
        <section class="container">
            <!-- /.row -->

            <?php
            $sql = "select * from hoadon,thanhvien,vanchuyen,thanhtoan where hoadon.mathanhvien=thanhvien.mathanhvien and hoadon.mavanchuyen=vanchuyen.mavanchuyen and hoadon.mathanhtoan=thanhtoan.mathanhtoan and hoadon.mahoadon='$mahoadon'";
            GLOBAL $connect;
            $kq = $connect->query($sql);
            $rowhoadon = mysqli_fetch_array($kq);
            ?>
            <section class="login-grids">
                <h2>Thông tin hóa đơn số <?php echo $_GET['mahoadon'] ?></h2>
                <form method="post" id="orderForm">
                    <section class="login">
                        <section class="login-right">
                            <h3><span class="glyphicon glyphicon-user"></span> Thông tin người đặt</h3>
                            <section class="sign-in">
                                <h4>Họ tên người đặt :</h4>
                                <input type="text" class="order-c" name="tennguoidat" value="<?= $rowhoadon['hoten'] ?>"
                                       disabled>
                            </section>
                            <section class="sign-in">
                                <h4>Địa chỉ người đặt :</h4>
                                <input type="text" class="order-c" name="diachinguoidat"
                                       value="<?= $rowhoadon['diachi'] ?>" disabled>
                            </section>
                            <section class="sign-in">
                                <h4>Điện thoại người đặt :</h4>
                                <input type="text" class="order-c" name="dienthoainguoidat"
                                       value="<?= $rowhoadon['dienthoai'] ?>" disabled>
                            </section>
                            <section class="sign-in">
                                <h4>Email người đặt :</h4>
                                <input type="text" class="order-c" name="emailnguoidat"
                                       value="<?= $rowhoadon['email'] ?>" disabled>
                            </section>
                        </section>
                        <section class="login-bottom">
                            <h3><span class="glyphicon glyphicon-user"></span> Thông tin người nhận</h3>
                            <section class="sign-up">
                                <h4>Họ tên người nhận :</h4>
                                <input type="text" class="order-c" name="hotennguoinhan" id="hoten"
                                       value="<?= $rowhoadon['hoten'] ?>" disabled>
                            </section>
                            <section class="sign-up">
                                <h4>Địa chỉ người nhận :</h4>
                                <input type="text" class="order-c" name="diachinguoinhan" id="diachi"
                                       value="<?= $rowhoadon['diachi'] ?>" disabled>
                            </section>
                            <section class="sign-up">
                                <h4>Điện thoại người nhận :</h4>
                                <input type="text" class="order-c" name="dienthoainguoinhan" id="dienthoai"
                                       value="<?= $rowhoadon['dienthoai'] ?>" disabled>
                            </section>
                            <section class="sign-up">
                                <h4>Email người nhận :</h4>
                                <input type="text" class="order-c" name="emailnguoinhan" id="email"
                                       value="<?= $rowhoadon['email'] ?>" disabled>
                            </section>
                            <?php
                            if ($rowhoadon['ghichu'] != NULL) {
                                ?>
                                <section class="sign-up">
                                    <h4>Ghi chú:</h4>
                                    <textarea class="order-c" name="ghichu"
                                              id="ghichu"><?= $rowhoadon['ghichu'] ?></textarea>
                                </section>
                            <?php } ?>
                        </section>
                        <section class="login-right">
                            <h3><span class="glyphicon glyphicon-user"></span> Phương thức thanh toán</h3>
                            <section class="sign-up">
                                <h4>Phương thức thanh toán :</h4>
                                <input type="text" class="order-c" name="emailnguoinhan" id="email"
                                       value="<?= $rowhoadon['hinhthuctt'] ?>" disabled>
                            </section>
                        </section>
                        <section class="login-bottom">
                            <h3><span class="glyphicon glyphicon-user"></span> Phương thức vận chuyển</h3>
                            <section class="sign-up">
                                <h4>Phương thức vận chuyển :</h4>
                                <input type="text" class="order-c" name="emailnguoinhan" id="email"
                                       value="<?= $rowhoadon['hinhthucvc'] ?>" disabled>
                            </section>
                        </section>
                        <section class="col-lg-12" id="sanpham">
                            <h3>Danh sách sản phẩm </h3>
                            <section class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Màu</th>
                                        <th>Size</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $stt = 0;
                                    $sql = "select sanpham.anhdaidien,sanpham.tensanpham,mau.tenmau,size.tensize,chitiethoadon.gia,chitiethoadon.soluong from chitiethoadon,mau,size,chitietsanpham,sanpham where chitiethoadon.machitietsp=chitietsanpham.machitiet and chitietsanpham.masp=sanpham.masanpham and chitietsanpham.mamau=mau.mamau and chitietsanpham.masize=size.masize and chitiethoadon.mahoadon='$mahoadon'";
                                    GLOBAL $connect;
                                    $kq1 = $connect->query($sql);
                                    while ($rowchitiet = mysqli_fetch_array($kq1)) {
                                        ?>
                                        <tr>
                                            <td><?= ++$stt; ?></td>
                                            <td><img src="images/<?= $rowchitiet['anhdaidien'] ?>" width="80px"
                                                     height="100px" class="img-responsive"></td>
                                            <td><?= $rowchitiet['tensanpham'] ?></td>
                                            <td><?= $rowchitiet['tenmau'] ?></td>
                                            <td><?= $rowchitiet['tensize'] ?></td>
                                            <td><?= number_format($rowchitiet['gia'], 0, ',', '.') ?> vnđ</td>
                                            <td>
                                                <?php if ($rowhoadon['trangthaihoadon'] == 1) { ?>
                                                    <input name="soluong[]"
                                                           value="<?= number_format($rowchitiet['soluong'], 0, ",", ".") ?>"
                                                           size="3" maxlength="2" style="text-align:right"/>
                                                <?php } else { ?>
                                                    <input name="soluong[]"
                                                           value="<?= number_format($rowchitiet['soluong'], 0, ",", ".") ?>"
                                                           size="3" maxlength="2" style="text-align:right" disabled/>
                                                <?php } ?>
                                            </td>
                                            <?php
                                            $tongtien = 0;
                                            $tong = $rowchitiet['gia'] * $rowchitiet['soluong'];
                                            $tongtien += $tong;
                                            ?>
                                            <td><?= number_format($tong, 0, ',', '.') ?> vnđ</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </section>
                        </section>
                        <section class="col-lg-12">
                            <ul class="list-group" style="text-align: right; font-weight: bolder;margin-bottom: 10px">
                                <li class="list-group-item" style="font-weight: none;">Tổng tiền
                                    hàng: <?= number_format($tongtien, 0, ',', '.') ?> vnđ
                                </li>
                                <li class="list-group-item" style="font-weight: none;">Tiền vận
                                    chuyển: <?= number_format($rowhoadon['giacuoc'], 0, ',', '.') ?> vnđ
                                </li>
                                <li class="list-group-item" id="ttttoan">Tổng tiền cần thanh
                                    toán: <?= number_format($rowhoadon['giacuoc'] + $tongtien, 0, ',', '.') ?> vnđ
                                </li>
                            </ul>
                        </section>
                        <section class="col-lg-12" style="margin-bottom: 10px">
                            <section class="form-group">
                                <label class="control-label col-md-2 col-sm-12" style="font-weight: none">Trạng thái hóa
                                    đơn: </label>
                                <section class="col-md-3 col-sm-12">
                                    <?php if ($rowhoadon['trangthaihoadon'] == 1) { ?>
                                        <select name="trangthai" class="form-control">
                                            <option value="1" selected>Chưa xử lý</option>
                                            <option value="4">Hủy hóa đơn</option>
                                        </select>
                                    <?php } elseif ($rowhoadon['trangthaihoadon'] == 2) { ?>
                                        <select name="trangthai" class="form-control" disabled="">
                                            <option value="2" selected>Đang xử lý</option>
                                        </select>
                                    <?php } elseif ($rowhoadon['trangthaihoadon'] == 3) { ?>
                                        <select name="trangthai" class="form-control" disabled="">
                                            <option value="3" selected>Đã xử lý</option>
                                        </select>
                                    <?php } else { ?>
                                        <select name="trangthai" class="form-control" disabled="">
                                            <option value="4" selected>Hóa đơn bị hủy</option>
                                        </select>
                                    <?php } ?>
                                </section>
                            </section>
                        </section>
                        <section class="login-top">
                            <section class="submit-order">
                                <?php if ($rowhoadon['trangthaihoadon'] == 1) { ?>
                                    <input type="submit" value="Cập nhật hóa đơn" name="suahoadon">
                                <?php } else { ?>
                                    <input type="submit" value="Cập nhật hóa đơn" name="suahoadon" disabled="">
                                <?php } ?>
                            </section>
                        </section>
                        <section class="clearfix"></section>
                    </section>
                </form>
            </section>
        </section>
    </section>
<?php } ?>