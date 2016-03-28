<div class="card">
    <div class="card-header bgm-cyan">
        <h2>Резульаты голосов для чиновника по id= 74</h2>
    </div>

    <div class="card-body card-padding">
       <div class="listview">
            <div class="lv-item">
                 
                <?php if(!empty($achievements)){ ?>
                    <table class="table table-striped " id="table_mer_team">
                      <thead>
                          <tr>
                              <th data-sort="int">IP</th>
                              <th data-sort="int">Да</th>
                              <th data-sort="int">Нет</th>
                              <th data-sort="int">Незнаю</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($achievements as $key=>$ac) { ?>
                        <tr>
                          <td><?php echo $key; ?></td>
                          <td><?php echo (!empty($ac[1]['count']))?$ac[1]['count']:'0'; ?></td>
                          <td><?php echo (!empty($ac[0]['count']))?$ac[0]['count']:'0'; ?></td>
                          <td><?php echo (!empty($ac[2]['count']))?$ac[2]['count']:'0'; ?></td>
                      </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                <?php }?>
                
                
            </div>
        </div>
    </div>
</div>