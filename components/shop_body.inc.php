<div class="p-0 m-0">
    <div class="row flex-nowrap overflow-hidden">
        
        <div class="collapse d-md-block col-12 col-md-2 p-0 pt-5 bg-dark text-dark" id="sidebar">
            
            <ul>
            <li class="mt-3">
                <button class="btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Home
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded text-white">Overview</a></li>
                        <li><a href="#" class="link-dark rounded text-white">Updates</a></li>
                        <li><a href="#" class="link-dark rounded text-white">Reports</a></li>
                    </ul>
                </div>
            </li>
            </ul>
        
            <!-- Sidebar toggle -->
            <div class="d-md-none text-white d-flex justify-content-left">
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" 
                data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar footer">
                Toggle Sidebar
                </button>
            </div>

        </div>

        <div class="col px-0 mt-4 pt-5">

            <!-- Sidebar toggle -->
            <div class="d-md-none col-auto text-white d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" 
                data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
                Toggle Sidebar
                </button>
            </div>

            <!-- Store items -->
            <div class="row row-cols-2 row-cols-md-3 p-1 m-0">

                <?php require('../components/store_item_display.inc.php'); ?> 
                
            </div>
        </div>
    </div>
</div>