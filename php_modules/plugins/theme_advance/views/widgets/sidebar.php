<div class="position-fixed d-none sidebar-left h-100 d-flex align-items-center">
    <div>
        <div>
            <button type="button" data-status="open" class="btn btn-primary button-left button-hidden-menu">
                <i class="fa-solid fa-caret-left"></i>
            </button>
        </div>
        <?php foreach($this->sidebar as $item) : ?>
            <?php if($item['type'] == 'popup') : ?>
                <div class="mt-4">
                    <button type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="#<?php echo $item['target']?>"
                        <?php if(isset($item['tooltip']) && $item['tooltip']) : ?>
                            data-bs-toggle="tooltip" 
                            title="<?php echo $item['tooltip']; ?>"
                            data-bs-placement="top"
                        <?php endif; ?>
                        class="btn btn-primary button-toogle-left  button-left w-100">
                        <?php echo $item['icon']; ?><?php echo $item['title']; ?>
                    </button>
                </div>
            <?php elseif($item['type'] == 'dropdown') :  ?>
                <div class="dropend mt-4">
                    <button class="btn button-toogle-left dropdown-hide btn-primary button-left w-100 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $item['icon']; ?><?php echo $item['title']; ?>
                    </button>
                    <ul class="dropdown-menu">
                        <?php if ($item['dropdown_menu']) : ?>
                            <?php foreach ($item['dropdown_menu'] as $index => $value) : ?>
                                <?php if($index) : ?>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?php echo $value['link']; ?>"><?php echo $value['title']; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif;?>
        <?php endforeach;?> 
        <?php if ($this->title_page_edit || is_array($this->button_header)) : ?>
            <div class="mt-4">
                <button type="button" class=" button-toogle-left btn btn-primary button-left w-100" type="button" data-bs-toggle="collapse" data-bs-target="#actionButtonCollapse" aria-expanded="false">
                    Actions
                </button>
                <div class="collapse w-100 button-toogle-left" id="actionButtonCollapse">
                    <?php if ($this->title_page_edit) :?>
                        <div>
                            <button id="apply_header" class="button-left w-100 mt-4 btn-outline-success btn_apply btn">Apply</button>
                        </div>
                        <?php if ($this->link_preview) : ?>
                        <div>
                            <a href="<?php echo $this->link_preview; ?>" class="button-left w-100 mt-4 btn btn-outline-success">Preview</a>
                        </div>
                        <?php endif; ?>
                        <div>
                            <a href="<?php echo $this->link_list; ?>" class="button-left w-100 mt-4 btn btn-outline-secondary">Cancel</a>
                        </div>
                    <?php endif;?>
                    <?php if (is_array($this->button_header)) 
                    {
                        foreach($this->button_header as $button)
                        {
                            echo  '<div><a href="'. $button['link'].'" class="mt-4 '. str_replace('ms-2', '', $button['class']).' button-left w-100 ">
                                '. $button['title'].'
                            </a></div>';
                        }
                    } ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $('.sidebar-left .button-hidden-menu').on('click', function(){
        if ($(this).data('status') == 'open')
        {
            $(this).attr('data-status', 'close');
            $(this).data('status', 'close');
            $('.sidebar-left .button-hidden-menu i').removeClass('fa-caret-left');
            $('.sidebar-left .button-hidden-menu i').addClass('fa-caret-right');
            $('.sidebar-left .button-toogle-left').removeClass('button-show');
            $('.sidebar-left .button-toogle-left').addClass('button-hidden');
        }
        else
        {
            $(this).attr('data-status', 'open');
            $(this).data('status', 'open');
            $('.sidebar-left .button-hidden-menu i').addClass('fa-caret-left');
            $('.sidebar-left .button-hidden-menu i').removeClass('fa-caret-right');
            $('.sidebar-left .button-toogle-left').addClass('button-show');
            $('.sidebar-left .button-toogle-left').removeClass('button-hidden');
        }
    });
 
    if ( window !== window.parent ) 
    {
        $('.sidebar-left').remove();
    } 
    else
    {
        $('.sidebar-left').removeClass('d-none');
    }
</script>
<?php foreach($this->sidebar as $item) : ?>
    <?php if($item['type'] == 'popup' ) : ?>
        <?php echo $this->renderWidget($item['widget']); ?>
    <?php endif; ?>
<?php endforeach; ?>