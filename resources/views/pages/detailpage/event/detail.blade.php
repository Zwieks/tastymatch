<!-- {{$debugpath}} -->
<div id="component-menu" class="content product-wrapper foodstand-menu-items">
    <h2>{{ Lang::get('detailpage.event-details') }}</h2>
    @include('forms.detailpagemenu')
    <div class="add-menu-wrapper js-add-menuitem">
        <span class="add-menuitem" data-icon="Z">{{ Lang::get('buttons.add-menu-item') }}</span>
    </div>    
</div>