<?php
/**
 * @var $arResult array     array with Deal[] items
 */
?>

<div class="deal-table">
    <div class="deals-table-title d-tr">
        <span class="deal-control d-td">Действия</span>
        <span class="deal-date d-td">Дата</span>
        <span class="deal-comment d-td">Комментарий</span>
    </div>
    <?foreach ($arResult as $dealItem):?>
        <div class="deal-item d-tr" data-item-id="<?=$dealItem->getId()?>">
                <span class="deal-control d-td">
                    <span class="edit-deal-item" title="Изменить"></span>
                    <span class="delete-deal-item" title="Удалить"></span>
                </span>
            <span class="deal-date d-td"><?=$dealItem->getDateTime()->format('d.m.Y')?></span>
            <span class="deal-comment d-td"><?=$dealItem->getComment()?></span>
        </div>
    <?endforeach;?>
</div>