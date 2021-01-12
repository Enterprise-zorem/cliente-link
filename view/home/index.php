
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
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <!--START GLOBAL LINKS -->
                        <div id="global" class="card balance-widget">
                            <div class="card-header border-0 py-0">
                                <h4 class="card-title">Links </h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="balance-widget">
                                    <div class="total-balance">
                                        <h3>{{totalClicks}}</h3>
                                        <h6>Total Clicks</h6>
                                    </div>
                                    <div class="links">
                                    <ul class="list-unstyled" >
                                        <li class="crypto" v-for="row in links">
                                            <a @click="clicklink(row.id,row.title,row.link,row.created_at,row.counter,row.enabled,row.token)">
                                            <div class="media-body">
                                                <h4 class="m-0">{{row.title}}</h4>
                                            </div>
                                            <div class="text-right">
                                                <h5>{{row.counter}} Clicks</h5>
                                                <span><?php echo RUTA ?>{{row.token}}</span>
                                            </div>
                                            </a>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END GLOBAL LINKS -->
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-6">
                        <div class="card acc_balance">
                            <div class="card-header">
                                <h4 class="card-title">{{title}}</h4>
                            </div>
                            <div class="card-body">
                                <span>{{link}}</span>
                                <h3>{{counter}} Clicks</h3>
                                <div class="d-flex justify-content-between my-4">
                                    
                                    <div>
                                        <p class="mb-1">Fecha de Creacion</p>
                                        <h4>{{created_at}}</h4>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between my-4">
                                    <div>
                                        <p class="mb-1">URL Corta</p>
                                        <table>
                                        <td><input autocomplete="off" type="text" v-model="token"  id="token" class="form-control"></td>
                                        <td><button class="btn btn-primary waves-effect" data-clipboard-target="#token">Copiar</button></td>
                                        </table>
                                    </div>
                                    
                                </div>
                                <div class="d-flex justify-content-between my-4">
                                <div v-if="token" class="output">
                                        <img :src="newQRCode" alt="QRCode" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between my-4">
                                    <div>
                                        <p class="mb-1">URL Extra Corta</p>
                                        <table>
                                        <td><input autocomplete="off" type="text" v-model="token2"  id="token2" class="form-control"></td>
                                        <td><button class="btn btn-primary waves-effect" data-clipboard-target="#token2">Copiar</button></td>
                                    </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between my-4">
                                <div v-if="token" class="output">
                                        <img :src="newQRCode2" alt="QRCode" />
                                    </div>
                                </div>
                                <div class="btn-group mb-3">
                                    <button @click="btnBorrarLink()" class="btn btn-primary">Eliminar</button>
                                    
                                   <button @click="btnEditarURL(id,title,token0)" class="btn btn-success">Modificar URL</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div  class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Todas las actividades</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="transaction-table">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <td>Plataforma</td>
                                                    <td>Navegador</td>
                                                    <td>Ipv4</td>
                                                    <td>Fecha/Hora</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="rows in activities">
                                                    <td>
                                                        <span class="badge badge-danger">{{rows.platform}}</span>
                                                    </td>
                                                    <td>
                                                         {{rows.browser}}
                                                    </td>
                                                    <td>
                                                    {{rows.ipv4}}
                                                    </td>
                                                    <td class="text-danger">{{rows.created_at}}</td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
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
