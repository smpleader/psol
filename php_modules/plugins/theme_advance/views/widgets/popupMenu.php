<div class="modal fade" id="popupMenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="popupMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <?php foreach($this->menu as $index => $item) : ?>
                    <li class="nav-item" role="presentation">
                        <?php if(isset($item[3]) && $item[3]) :?>
                        <button class="nav-link <?php //echo $index == 0 ? 'active' : '';?>" id="<?php echo $item[1]; ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $item[1]; ?>_tabpanel" type="button" role="tab" aria-controls="<?php echo $item[1]; ?>" aria-selected="true">
                            <?php echo $item[2];?>
                        </button>
                        <?php else : ?>
                        <a href="<?php echo $this->url. $item[1];?>" class="nav-link <?php //echo $index == 0 ? 'active' : '';?>" >
                            <?php echo $item[2];?>
                        </a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach;?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="tab-content p-3">
                    <?php foreach($this->menu as $index => $item) : ?>
                        <?php if(isset($item[3]) && $item[3]) :?>
                        <div class="tab-pane fade <?php //echo $index == 0 ? 'show active' : '';?>" id="<?php echo $item[1] . '_tabpanel'; ?>" role="tabpanel" aria-labelledby="<?php echo $item[1]; ?>-tab">
                            <?php echo $this->renderWidget($item[3]); ?>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>