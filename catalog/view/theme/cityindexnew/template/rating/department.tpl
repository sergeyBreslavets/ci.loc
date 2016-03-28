<?php echo $header; ?>

    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container-fluid container-custom">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h2 class="module-title font-alt">  РЕЙТИНГ ЗАМЕТНОСТИ ДЕПАРТАМЕНТОВ ПРАВИТЕЛЬСТВА МОСКВЫ В СОЦИАЛЬНЫХ МЕДИА <br>
1-16 февраля 2016 </h2>
                        <p class="module-subtitle">Исследовательский центр Cityindex подготовил рейтинг заметности департаментов Правительства Москвы на основе упоминаний в социальных медиа за февраль 2016 года.  <br>
В рейтинг вошли департаменты, деятельность которых связана с оказанием услуг населению, а значит – может быть оценена и обсуждаться горожанами. <br>

                             <a href="#" type="button" data-toggle="modal" data-target="#metod">Методика составления рейтинга.</a>

                          
                            <br> </p>
                        <div class="link-bottom hidden">
                            <a class="to-top-link " href="#about_ret" data-toggle="tooltip" title="пояснения к рейтингу">
                                <i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /MODULE TITLE -->
                <div class="row ">
                   <div class="col-sm-12 col-md-offset-2 col-md-8">
                       <form action="<?php echo $action; ?>" method="get" enctype="multipart/form-data" id="form-information" >
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group filter">
                        <label class="font-alt">начальная дата</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control filter--input" name="date_begin"/>
                                <span class="input-group-addon filter--addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group filter">
                        <label class="font-alt">конечная дата</label>
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' class="form-control filter--input" name="date_finish"/>
                                <span class="input-group-addon filter--addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                        <div class="col-xs-12 col-sm-6 filter"><button type="submit" class="btn btn-block btn-round btn-dark filter--button">Показать</button></div>
                    </form>
                   </div> 
                </div>


                    <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center m-b-60">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th class="hidden">Динамика
                                            <div class="tolbar-box" data-toggle="tooltip" title="Изменение позиции объекта в рейтинге по сравнению с предыдущим периодом" data-placement="top"></div>
                                        </th>
                                        <th>Орган власти</th>
                                        <th>
                                            <div class="tolbar-box" data-toggle="tooltip" title="Суммарный охват первичных сообщений и репостов, без учета пересечений аудиторий" data-placement="top"></div>Суммарный охват сообщений</th>
                                        <th>
                                            <div class="tolbar-box" data-toggle="tooltip" title="Количество социальных действий: Likes + Shares + Comments" data-placement="top"></div>Суммарное число СД</th>
                                        <th class="active">Индекс заметности</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  <?php if(!empty($list)){ ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($list as $vl) { ?>
                                      <tr>
                                        <th scope="row"><?php echo $i;?></th>
                                        <td class="hidden"><?php echo $vl['object_positionChange'];?></td>
                                        <td class="title__table"><?php echo $vl['object_name'];?><div class="tolbar-box" data-toggle="tooltip" title="<?php echo $vl['object_description'];?>" data-placement="top" ></div></td>
                                        <td><?php echo $vl['object_total_posts_coverage'];?></td>
                                        <td><?php echo $vl['object_total_social']; ?></td>
                                        <td class="active"><?php echo $vl['object_index'];?></td>
                                      </tr>

                                    <?php $i++;} ?>
                                  <?php } ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /SERVICES -->
        <!-- POST -->
        <section class="module pt-0 pb-0" id="about_ret">
            <div class="container-fluid container-custom">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <!-- POST CONTENT -->
                        <article class="post">
                            <h5>Пояснения к рейтингу</h5>
                            <p>Artisan Intelligentsia PBR Pinterest, trust fund PBR&amp;B church-key fap gastropub Blue Bottle butcher listicle Thundercats before they sold out post-ironic. +1 authentic squid sartorial. Echo Park slow-carb hashtag mumblecore cred art party. Wolf direct trade banh mi gastro pub letterpress tattooed ugh hoodie fap trust fund viral sartorial.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- COUNTERS -->
        <!-- FOOTER -->
        

<?php echo $content_bottom; ?>

<?php echo $footer; ?>
