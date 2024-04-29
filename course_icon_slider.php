<!-- <Course Section> ============================================-->
<!-- <section> begin ============================-->
<section class="bg-light pt-6 rounded-bottom ">
    <div class="container px-5">
        <div class="col-md-6">
            <h1 class="text-dark fw-bold fs-4 pb-3">Explore Our Projects</h1>
        </div>
        <div class="swiper mt-8 pt-3 px-5">
            <div class="swiper-container swiper-theme" data-swiper='{"slidesPerView":1,"breakpoints":{"640":{"slidesPerView":1,"spaceBetween":10},"768":{"slidesPerView":2,"spaceBetween":20},"1025":{"slidesPerView":4,"spaceBetween":40}},"spaceBetween":10,"grabCursor":true,"pagination":{"el":".swiper-pagination","clickable":true},"navigation":{"nextEl":".swiper-button-next","prevEl":".swiper-button-prev"},"loop":true,"freeMode":true,"loopedSlides":3}'>
                <div class="swiper-wrapper">

                    <!-- Fetch course data -->
                    <?php
                    $sql_fetch_all_courses_icon = "SELECT cid, icon, title FROM course WHERE active_record = 'Yes' ORDER BY cid DESC LIMIT 0,10";
                    $result_sql_fetch_all_courses_icon = mysqli_query($conn, $sql_fetch_all_courses_icon) or die("Query Failed!!");
                    if (mysqli_num_rows($result_sql_fetch_all_courses_icon) > 0) {
                        while ($row_sql_fetch_all_courses_icon = mysqli_fetch_assoc($result_sql_fetch_all_courses_icon)) {
                    ?>
                            <div class="swiper-slide">
                                <a href="courses_single.php?course_id=<?php echo $row_sql_fetch_all_courses_icon['cid']; ?>">
                                    <img src="admin/upload_media/courses_poster/<?php echo $row_sql_fetch_all_courses_icon['icon'] ?>" alt="<?php echo $row_sql_fetch_all_courses_icon['title'] ?>" class="w-100" />
                                </a>
                            </div>
                    <?php }
                    } else {
                        echo "error";
                    } ?>


                </div>
            </div>
            <div class="swiper-button-next"><span class="fas fa-arrow-right fs-2"></span></div>
            <div class="swiper-button-prev"><span class="fas fa-arrow-left fs-2"></span></div>
        </div>
    </div>
    <!-- end of .container-->
</section>
<!-- <section> close ============================-->
<!-- <Course Section> ============================================-->
<!-- ============================================-->