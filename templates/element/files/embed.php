<?php
    $fileFormat = $file->getExtension();
    $filePath = 'uploads' . DS . $file->file;

    switch ($fileFormat) {
        case 'mpeg':
        case 'ogg':
        case 'wav':
            ?>
                <audio controls>
                    <source src="<?= DS . $filePath ?>" type="audio/<?= $fileFormat ?>">
                </audio>
            <?php
            break;
        case 'jpg':
        case 'jpeg':
        case 'gif':
        case 'png':
            echo $this->Glide->image($file->file, ['w' => 640], []);
            echo '<br>';
            echo '<a class="button tiny" href="'.$this->Glide->url($file->file, ['w' => 640], []).'">640px</a> ';
            echo '<a class="button tiny" href="'.$this->Glide->url($file->file, ['w' => 1280], []).'">1280px</a> ';
            echo '<a class="button tiny" href="'.$this->Glide->url($file->file, [], []).'">full width</a>';
            break;
        default:
            echo $this->Html->link('<i class="fi-download"></i> '.__('Download'), $filePath, ['class' => 'button small', 'escape' => false]);
    }

