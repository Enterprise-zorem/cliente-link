
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <?php 
        include "view/body_header.php";
        ?>

        
        <div class="verification section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6" v-for="rows in plans">
                        <div class="auth-form card" >
                            <!-- <div class="card-header">
                                <h4 class="card-title">Link a Debit card</h4>
                            </div> -->
                                <div class="card-body">
                                        <div class="identity-content">
                                            <span class="icon"><i class="fa fa-paypal"></i></span>
                                            <h4>{{rows.name}}</h4>
                                            <p><h2>${{rows.price_mounth}} /mo</h2></p>
                                            <p>{{rows.content}}</p>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" @click="btnUpgrade(rows.pk_plan)" class="btn btn-primary pl-5 pr-5">Upgrade to {{rows.name}}</button>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
        include "view/footer.php";
        ?>

    </div>
