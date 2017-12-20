<ul class="nav nav-list">
    <li class="nav-header active">
        <a href="<?php echo Yii::app()->createUrl('//Admin/Index'); ?>">
            <i class="icon-home"></i> 
            Home
        </a>
    </li>

    <!-- User -->
    <li class="nav-header active">
        <a href="<?php echo Yii::app()->createUrl('//Member/Users'); ?>">
            <i class="icon-user"></i> 
            User
        </a>
        <ul class="nav nav-list">
            <li>
                <a href="<?php echo Yii::app()->createUrl('//Member/Users'); ?>">
                    All Users
                </a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('//Member/UserAdd'); ?>">
                    Add New
                </a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('//Member/UserProfile'); ?>">
                    Profile
                </a>
            </li>
        </ul>
    </li>

    <!-- Media [Gallery | Image | Video | Slide] -->
    <li class="nav-header active">
        <a href="<?php echo Yii::app()->createUrl('//Media/MediaALL'); ?>">
            <i class="icon-picture"></i> 
            Media
        </a>
        <ul class="nav nav-list">
            <li class="text-success">
                Gralry
                <ul class="nav nav-list">
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaLibaryGallry'); ?>">
                            Library
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaGallryAdd'); ?>">
                            Add New
                        </a>
                    </li> 
                </ul>
            </li>
        </ul>
        <ul class="nav nav-list">
            <li class="text-success">
                Image
                <ul class="nav nav-list">
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaLibaryImage'); ?>">
                            Library
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaImageAdd'); ?>">
                            Add New
                        </a>
                    </li> 
                </ul>
            </li>
        </ul>

        <ul class="nav nav-list">
            <li class="text-success">
                Video
                <ul class="nav nav-list">
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaLibaryVideo'); ?>">
                            Library
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaVideoAdd'); ?>">
                            Add New
                        </a>
                    </li> 
                </ul>
            </li>
        </ul>

        <ul class="nav nav-list">
            <li class="text-success">
                Slide
                <ul class="nav nav-list">
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaLibarySlide'); ?>">
                            Library
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('//Media/MediaSlideAdd'); ?>">
                            Add New
                        </a>
                    </li> 
                </ul>
            </li>
        </ul>
    </li>

    <li class="nav-header active">
        <a href="#">
            <i class="icon-file"></i> 
            Pages & Post
        </a>

        <ul class="nav nav-list">
            <li>
                <b class="text-success">Page</b>
                <ul class="nav nav-list">
                    <a href="<?php echo Yii::app()->createUrl("//Pages/Pages/"); ?>">
                        <li>All Page</li>
                    </a>
                </ul>
            </li>

            <li>
                <b class="text-success">Post</b>
                <ul class="nav nav-list">
                    <li>
                        <a href="<?php echo Yii::app()->createUrl("//Posts/PostAll/"); ?>">
                            All Post
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl("//Posts/PostAdd/"); ?>">
                            Add New Post
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
<!--
    <li class="nav-header active">
        <a href="#">
            <i class="icon-facetime-video"></i> 
            Socal
        </a>
        <ul class="nav nav-list">
            <li>
                <a href="<?php echo Yii::app()->createUrl("//Posts/PostAll/"); ?>">
                    Library
                </a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl("//Posts/PostAdd/"); ?>">
                    Add New
                </a>
            </li>
        </ul>
    </li>
-->
    <li class="nav-header active">
        <a href="#">
            <i class="icon-star-empty"></i> 
            system
        </a>
        <ul class="nav nav-list">
            <li>
                <a href="<?php echo Yii::app()->createUrl('//site/index'); ?>" class="text-success">
                    <i class="icon-fast-backward"></i> 
                    Back to Home page
                </a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('//Admin/Logout'); ?>" class="text-error">
                    <i class="icon-lock"></i> 
                    Logout
                </a>
            </li>
        </ul>
    </li>

</ul>