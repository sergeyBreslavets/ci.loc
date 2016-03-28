<div class="card rating-list">
                            <div class="listview">
                                <div class="lv-header">
                                    <div class="m-t-5">
                                        <h3>Результаты теста "" </h3>
                                        <h4>Всего битв: <?php echo $count_voices; ?> </h4>
                                    </div>
                                    
                                </div>
                                
                                <div class="lv-body">
                                    <div class="p-15">
                                        <div class="lv-item">
                                            <div class="media">
                                                <div class="pull-left" style="width:100px;">
                                                    Собянин победил
                                                </div>
                                                
                                                <div class="pull-right"><?php echo $results_battle['win_mer_1']; ?></div>
                                                
                                                <div class="media-body">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $results_battle['_win_percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $results_battle['_win_percent']; ?>%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="lv-item">
                                            <div class="media">
                                                 <div class="pull-left" style="width:100px;">
                                                    Собянин проиграл
                                                </div>
                                                
                                                <div class="pull-right"><?php echo $results_battle['win_mer_2']; ?></div>
                                                
                                                <div class="media-body">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $results_battle['_fail_percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $results_battle['_fail_percent']; ?>%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="lv-item">
                                            <div class="media">
                                                 <div class="pull-left" style="width:100px;">
                                                    Ничья
                                                </div>
                                                
                                                <div class="pull-right"><?php echo $results_battle['friend']; ?></div>
                                                
                                                <div class="media-body">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $results_battle['_friend_percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $results_battle['_friend_percent']; ?>%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>