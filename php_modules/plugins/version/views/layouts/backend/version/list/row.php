<tr>
    <td>
        <input class="checkbox-item" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td>
        <a href="#"
            class="show_data"
            data-id="<?php echo  $this->item['id'] ?>" 
            data-name="<?php echo  htmlspecialchars($this->item['name'])  ?>" 
            data-description="<?php echo  htmlspecialchars($this->item['description'] ?? '')  ?>" 
            data-version_number="<?php echo $this->item['version']; ?>" 
            data-release_date="<?php echo   $this->item['release_date'] ? date('Y-m-d', strtotime($this->item['release_date'])) : '';?>" 
            data-bs-placement="top" 
            data-bs-toggle="modal" 
            data-bs-target="#exampleModalToggle">
            <?php echo  $this->item['name']  ?>
        </a>
    </td>
    <td>
        <?php  echo $this->item['version']?>
    </td>
    <td>
        <?php echo  strlen($this->item['description']) > 50 ? substr($this->item['description'], 0, 50) .'...' : $this->item['description'];  ?>
    </td>
    <td>
        <?php 
        $logs = $this->get_log;
        if(count($logs) > 3){
            $logs_list = '<ul>';
            foreach($logs as $log)  {
                if($log['version_id'] == $this->item['id']){
                    $logs_list .= '<li>' . $log['log'] . '</li>';
                }
            }
            $logs_list .= '</ul>';
 
            echo '<a href="#" class="show_data" data-logs="' . $logs_list . '" data-name="' . item['name'] .'" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#showChangeLogsModal">';
            for ($i=0;$i<3;$i++) {
                if($logs[$i]['version_id'] == $this->item['id']){
                    echo '<span>'. '- ' . $logs[$i]['log'] . '</span> <br>'; 
                }
            }
            echo '...';
        } else {
            foreach($logs as $log)  {
                if($log['version_id'] == $this->item['id']){
                    echo '<span>'. '- ' . $log['log'] . '</span> <br>'; 
                }
            }
        }
        ?>
    </td>
    <td><?php echo   $this->item['release_date'] ? date('m-d-Y', strtotime($this->item['release_date'])) : '';  ?></td>
    <td>
        <?php  echo $this->item['feedback']?>
    </td>
    <td>
        <a class="fs-4 me-1" href="<?php echo $this->link_form . '-feedback/' . $this->item['id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Go to feedback"><i class="fa-solid fa-message"></i></a>
    </td>
</tr>

<div class="modal fade" id="showChangeLogsModal" aria-labelledby="showChangeLogsModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered " style="max-width: 600px;">
        <div class="modal-content container px-5 pt-5">
                <div class="row g-3 align-items-center">
                    <div class="row">
                        <div class="mb-3 col-12 mx-auto pt-3">
                            <h2></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 mx-auto">
                            <div class="row">
                                <div class="col-3 d-flex align-items-center">
                                    <label class="form-label fw-bold mb-0">Release Date</label>
                                </div>
                                <div class="col-9">
                                    <?php $this->ui->field('release_date'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>