<div class="panel panel-default sidebar-menu"> 
    <div class="panel-heading">
    
        <h3 class="panel-title">Categorias
            <div class="pull-right">
                <a href="JavaScript:Void(0);" style="color: black;">
                <span class="nav-toggle hide-show">
                    Hide
                </span>
                </a>
            </div>
        </h3>
    
    </div>

    
    <div class="panel-collapse collapse-data">

        <div class="panel-body">   
            <div class="input-group">
                <input type="text" class="form-control" id="dev-table-filter" data-filters="#dev-categories_p" data-action="filter" placeholder="Filtro Categorias" id="dev-manufacturer">
                <a href="" class="input-group-addon">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </div>
        <div class="panel-body scroll-menu">

            
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-manufacturer">
        
            <?php 
            getcats();
            ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel panel-default sidebar-menu"> 
    <div class="panel-heading">
    
        <h3 class="panel-title">Categorias de produto
            <div class="pull-right">
                <a href="JavaScript:Void(0);" style="color: black;">
                <span class="nav-toggle hide-show">
                    Hide
                </span>
                </a>
            </div>
        </h3>
    
    </div>

    
    <div class="panel-collapse collapse-data">

        <div class="panel-body">   
            <div class="input-group">
                <input type="text" class="form-control" id="dev-table-filter" data-filters="#dev-categories_p" data-action="filter" placeholder="Filtro Categorias de produto" id="dev-manufacturer">
                <a href="" class="input-group-addon">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </div>
        <div class="panel-body scroll-menu">

            
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-manufacturer">
        
            <?php 
            getpcats();

            ?>
            </ul>
        </div>
    </div>
</div>

