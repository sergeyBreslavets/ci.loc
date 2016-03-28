<div class="card">
    <div class="card-header bgm-cyan">
        <h2>Резульаты теста мерская команда </h2>
        <h2>Всего голосов: <?php echo $count_voices; ?> </h2>
    </div>

    <div class="card-body card-padding">
       <div class="listview">
            <div class="lv-item">
                 
                <?php if(!empty($achievements)){ ?>
                    <table class="table table-striped " id="table_mer_team">
                      <thead>
                          <tr>
                              <th data-sort="int">Место</th>
                              <th data-sort="string">Фото</th>
                              <th data-sort="string">Чиновник</th>
                              <th data-sort="int">Да<span class="arrow">&darr;</span></th>
                              <th data-sort="int">Нет</th>
                              <th data-sort="int">Незнаю</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($achievements as $ac) { ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><img class="lv-img-sm" src="<?php echo $ac['placeman_image']; ?>" alt=""></td>
                          <td>
                            <div class="lv-title"><?php echo $ac['placeman_name']; ?></div>
                            </td>
                          <td><?php echo $ac['placeman_1']; ?></td>
                          <td><?php echo $ac['placeman_0']; ?></td>
                          <td><?php echo $ac['placeman_2']; ?></td>
                      </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                <?php }?>
                
                
            </div>
        </div>
    </div>
</div>

  
<script type="text/javascript">
  $(document).ready(function(){
      //Basic Example
      if($("#table_mer_team").length > 0 ){
       /* $("#table_occasion_group_<?php echo $occasion_group['occasion_group_id'];?>").bootgrid({
          navigation:2,
          padding:0
         });*/

         var table_mer_team = $("#table_mer_team").stupidtable();
         table_mer_team.on("beforetablesort", function (event, data) {
            
          });

          table_mer_team.on("aftertablesort", function (event, data) {
            // Reset loading message.

            var th = $(this).find("th");
            th.find(".arrow").remove();
            var dir = $.fn.stupidtable.dir;

            var arrow = data.direction === dir.ASC ? "&uarr;" : "&darr;";
            th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
          });
      }
      
  });
</script>