/*!
 * xRayAID
 * js/login_resize.js
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */


/* Add header and footer if windows size is <= 992px */
window.onload = function ()
{
    if ($(parent.window).width() < 992) {    
        if(document.getElementById("login-responsive") == null) /* iframe does not exist */
        {
            /* Insert Navbar */
            header_div = document.getElementById("navbar_div")
            header_div.innerHTML = "<nav class='navbar navbar-expand-lg navbar-light fixed-top navbar-shrink' id='mainNav'> \
                                        <div class='container'> \
                                            <a class='navbar-brand js-scroll-trigger' href='https://xrayaid.com.br'>xRayAID</a> \
                                            <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'> \
                                                Menu \
                                                <i class='fas fa-bars'></i> \
                                            </button> \
                                            <div class='collapse navbar-collapse' id='navbarResponsive'> \
                                                <ul class='navbar-nav ml-auto'> \
                                                    <li class='nav-item'><a class='nav-link js-scroll-trigger' href='https://xrayaid.com.br/#about'>Sobre</a></li> \
                                                    <li class='nav-item'><a class='nav-link js-scroll-trigger' href='https://xrayaid.com.br/#projects'>O Projeto</a></li> \
                                                    <li class='nav-item'><a class='nav-link js-scroll-trigger' href='https://xrayaid.com.br/#signup'>Inscrição</a></li> \
                                                    <li class='nav-item'><a class='nav-link js-scroll-trigger' href='https://mail.xrayaid.com.br'>Webmail</a></li> \
                                                </ul> \
                                            </div> \
                                        </div> \
                                    </nav>"

            /* Insert Footer */
            login_div = document.getElementById("page-footer")
            login_div.innerHTML = "<footer class='py-4 bg-light mt-auto'> \
                                        <div class='container-fluid'> \
                                            <div class='d-flex align-items-center justify-content-between small'> \
                                                <div class='text-muted'>Copyright &copy; <a class='js-scroll-trigger' href='https://xrayaid.com.br'>xRayAID.com.br</a> 2020</div> \
                                                <div> \
                                                    <a href='#!' id='politica'>Política de Privacidade</a> \
                                                    <div id='text-politica' class='modal'> \
                                                        <div class='modal-content scroll-auto' id='policy-content'> \
                                                            \
                                                        </div> \
                                                    </div> \
                                                    &middot; \
                                                    <a href='#!' id='termos'>Termos &amp; Condições</a> \
                                                    <div id='text-termos' class='modal'> \
                                                        <div class='modal-content scroll-auto' id='terms-content'> \
                                                            \
                                                        </div> \
                                                    </div> \
                                                </div> \
                                            </div> \
                                        </div> \
                                    </footer>"
            
            policy_div = document.getElementById("policy-content"); /* Get the div where the code below will be put */
            btn = document.getElementById("politica"); /* Get the button that opens the policy popup */
            term_div = document.getElementById("terms-content") /* Get the div where the code below will be put */
            btn_termos = document.getElementById("termos");     /* Get the button that opens the termos popup */

            /* Policy */
            btn.onclick = function add_modal() /* When click on "Politica de Privacidade" button, execute this script */
            {
                /* Insert the Text on the model div */
                insert_policy_text()

                /* Declaring the rest os variables that was put on code above */
                modal = document.getElementById("text-politica");    /* Get policy model div element */
                span = document.getElementsByClassName("close")[0]; /* Get the button that closes the policy popup */

                /* And fade in the content */
                $("#text-politica").fadeIn('slow');
                modal.style.display = "block";

                /* Here, we are declaring the close function when X is presses on the policy model div */
                span.onclick = function () 
                {
                    modal.style.display = "none";
                }
            }
            
            /* Terms */
            btn_termos.onclick = function () /* When click on "Termos de Uso" button, execute this script */
            {
                /* Insert the Text on the model div */
                insert_terms_text()
                
                /* Declaring the rest os variables that was put on code above */
                termos = document.getElementById("text-termos");    /* Get termos model div element */
                span_terms = document.getElementsByClassName("close-terms")[0]; /* Get the button that closes the termos popup */

                /* And fade in the content */
                $("#text-termos").fadeIn('slow');
                termos.style.display = "block";

                /* Here, we are declaring the close function when X is presses on the terms model div */
                span_terms.onclick = function () 
                {
                    termos.style.display = "none";
                }
            }
        }
    }
}

window.onclick = function (event) {
    try
    {
        if (event.target == modal) {
            // $("#text-politica").fadeOut('slow');
            modal.style.display = "none";
        }
    }
    catch(e) {}
    finally
    {
        try
        {
            if (event.target == termos) {
                // $("#text-termos").fadeOut('slow');
                termos.style.display = "none";
            }
        }
        catch(e) {}
        finally {}
    }
}

function insert_policy_text()
{
    /* Insert the Text on the model div */
    policy_div.innerHTML = "<div class='card-header  rounded-lg border'> \
                                <h3 class='text-center font-weight-light my-2'>Política de Privacidade</h3> \
                            </div> \
                            <div class='card-politic'> \
                                <p class='text-justify'>A sua privacidade é importante para nós. É política do xRayAID respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site <a href=index.php>xRayAID</a>, e outros sites que possuímos e operamos.</p> \
                                <p class='text-justify'>Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que estamos coletando e como será usado. </p> \
                                <p class='text-justify'>Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.</p> \
                                <p class='text-justify'>Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando exigido por lei.</p> \
                                <p class='text-justify'>O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas respectivas políticas de privacidade</a>. </p> \
                                <p class='text-justify'>Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não possamos fornecer alguns dos serviços desejados.</p> \
                                <p class='text-justify'>O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de privacidade e informações pessoais. Se você tiver alguma dúvida sobre como lidamos com dados do usuário e informações pessoais, entre em contacto connosco.</p> \
                            </div> \
                            <div class='card-header border'> \
                                <h3 class='text-center font-weight-light my-2'>Política de Cookies xRayAID</h3> \
                            </div> \
                            <div class='card-politic'> \
                                <div class='card-subtitle border rounded-lg'> \
                                    <h4 class='text-center font-weight-light mt-2 my-2'>O que são cookies?</h4> \
                                </div> \
                                &nbsp; \
                                <p class='text-justify'>Como é prática comum em quase todos os sites profissionais, este site usa cookies, que são pequenos arquivos baixados no seu computador, para melhorar sua experiência. Esta página descreve quais informações eles coletam, como as usamos e por que às vezes precisamos armazenar esses cookies. Também compartilharemos como você pode impedir que esses cookies sejam armazenados, no entanto, isso pode fazer o downgrade ou 'quebrar' certos elementos da funcionalidade do site.</p> \
                                &nbsp; \
                                <div class='card-subtitle border'> \
                                    <h4 class='text-center font-weight-light  mt-2 my-2'>Como usamos os cookies?</h4> \
                                </div> \
                                &nbsp; \
                                <p class='text-justify'>Utilizamos cookies por vários motivos, detalhados abaixo. Infelizmente, na maioria dos casos, não existem opções padrão do setor para desativar os cookies sem desativar completamente a funcionalidade e os recursos que eles adicionam a este site. É recomendável que você deixe todos os cookies se não tiver certeza se precisa ou não deles, caso sejam usados ​​para fornecer um serviço que você usa.</p> \
                                &nbsp; \
                                <div class='card-subtitle border'> \
                                    <h4 class='text-center font-weight-light  mt-2 my-2'>Desativar cookies</h4> \
                                </div> \
                                &nbsp; \
                                <p class='text-justify'>Você pode impedir a configuração de cookies ajustando as configurações do seu navegador (consulte a Ajuda do navegador para saber como fazer isso). Esteja ciente de que a desativação de cookies afetará a funcionalidade deste e de muitos outros sites que você visita. A desativação de cookies geralmente resultará na desativação de determinadas funcionalidades e recursos deste site. Portanto, é recomendável que você não desative os cookies.</p> \
                                &nbsp; \
                                <div class='card-subtitle border'> \
                                    <h4 class='text-center font-weight-light mt-2 my-2'>Cookies que definimos</h4> \
                                </div> \
                                &nbsp; \
                                <ul> \
                                    <li class='text-justify'> Cookies relacionados à conta<br><br> Se você criar uma conta connosco, usaremos cookies para o gerenciamento do processo de inscrição e administração geral. Esses cookies geralmente serão excluídos quando você sair do sistema, porém, em alguns casos, eles poderão permanecer posteriormente para lembrar as preferências do seu site ao sair.<br><br> </li> \
                                    <li class='text-justify'> Cookies relacionados ao login<br><br> Utilizamos cookies quando você está logado, para que possamos lembrar dessa ação. Isso evita que você precise fazer login sempre que visitar uma nova página. Esses cookies são normalmente removidos ou limpos quando você efetua logout para garantir que você possa acessar apenas a recursos e áreas restritas ao efetuar login.<br><br> </li> \
                                    <li class='text-justify'> Cookies relacionados a boletins por e-mail<br><br> Este site oferece serviços de assinatura de boletim informativo ou e-mail e os cookies podem ser usados ​​para lembrar se você já está registrado e se deve mostrar determinadas notificações válidas apenas para usuários inscritos / não inscritos.<br><br> </li> \
                                    <li class='text-justify'> Pedidos processando cookies relacionados<br><br> Este site oferece facilidades de comércio eletrônico ou pagamento e alguns cookies são essenciais para garantir que seu pedido seja lembrado entre as páginas, para que possamos processá-lo adequadamente.<br><br> </li> \
                                    <li class='text-justify'> Cookies relacionados a pesquisas<br><br> Periodicamente, oferecemos pesquisas e questionários para fornecer informações interessantes, ferramentas úteis ou para entender nossa base de usuários com mais precisão. Essas pesquisas podem usar cookies para lembrar quem já participou numa pesquisa ou para fornecer resultados precisos após a alteração das páginas.<br><br> </li> \
                                    <li class='text-justify'> Cookies relacionados a formulários<br><br> Quando você envia dados por meio de um formulário como os encontrados nas páginas de contacto ou nos formulários de comentários, os cookies podem ser configurados para lembrar os detalhes do usuário para correspondência futura.<br><br> </li> \
                                    <li class='text-justify'> Cookies de preferências do site<br><br> Para proporcionar uma ótima experiência neste site, fornecemos a funcionalidade para definir suas preferências de como esse site é executado quando você o usa. Para lembrar suas preferências, precisamos definir cookies para que essas informações possam ser chamadas sempre que você interagir com uma página for afetada por suas preferências.<br> </li> \
                                </ul> \
                                &nbsp; \
                                <div class='card-subtitle border'> \
                                    <h4 class='text-center font-weight-light mt-2 my-2'>Cookies de Terceiros</h4> \
                                </div> \
                                &nbsp; \
                                <p class='text-justify'>Em alguns casos especiais, também usamos cookies fornecidos por terceiros confiáveis. A seção a seguir detalha quais cookies de terceiros você pode encontrar através deste site.</p> \
                                <ul> \
                                    <li class='text-justify'> Este site usa o Google Analytics, que é uma das soluções de análise mais difundidas e confiáveis ​​da Web, para nos ajudar a entender como você usa o site e como podemos melhorar sua experiência. Esses cookies podem rastrear itens como quanto tempo você gasta no site e as páginas visitadas, para que possamos continuar produzindo conteúdo atraente. </li> \
                                </ul> \
                                <p class='text-justify'>Para mais informações sobre cookies do Google Analytics, consulte a página oficial do Google Analytics.</p> \
                                <ul> \
                                    <li class='text-justify'> As análises de terceiros são usadas para rastrear e medir o uso deste site, para que possamos continuar produzindo conteúdo atrativo. Esses cookies podem rastrear itens como o tempo que você passa no site ou as páginas visitadas, o que nos ajuda a entender como podemos melhorar o site para você.</li> \
                                    <li class='text-justify'> Periodicamente, testamos novos recursos e fazemos alterações subtis na maneira como o site se apresenta. Quando ainda estamos testando novos recursos, esses cookies podem ser usados ​​para garantir que você receba uma experiência consistente enquanto estiver no site, enquanto entendemos quais otimizações os nossos usuários mais apreciam.</li> \
                                    <li class='text-justify'> À medida que vendemos produtos, é importante entendermos as estatísticas sobre quantos visitantes de nosso site realmente compram e, portanto, esse é o tipo de dados que esses cookies rastrearão. Isso é importante para você, pois significa que podemos fazer previsões de negócios com precisão que nos permitem analizar nossos custos de publicidade e produtos para garantir o melhor preço possível.</li> \
                                </ul> \
                            </div> \
                            <div class='card-header border'> \
                                <h3 class='text-center font-weight-light my-2'>Mais informações</h3> \
                            </div> \
                            &nbsp; \
                            <div class='card-politic'> \
                                <p class='text-justify'>Esperemos que esteja esclarecido e, como mencionado anteriormente, se houver algo que você não tem certeza se precisa ou não, geralmente é mais seguro deixar os cookies ativados, caso interaja com um dos recursos que você usa em nosso site.</p> \
                                <p class='text-justify'>Esta política é efetiva a partir de <strong>Julho</strong>/<strong>2020</strong>.</p> \
                            </div> \
                            <span class='close d-flex justify-content-center'>&times;</br> </br></span> "
}

function insert_terms_text()
{
    /* Insert the Text on the model div */
    term_div.innerHTML =    "<div class='card-header  rounded-lg border'> \
                                <h3 class='text-center font-weight-light my-2'>Termos e Condições de Uso</h3> \
                            </div> \
                            &nbsp; \
                            <div class='card-politic'> \
                                <div class='card-header  rounded-lg border'> \
                                    <h3 class='text-center font-weight-light my-2'>1. Termos</h3>\
                            </div>\
                            &nbsp;\
                            <p class='text-justify'>Ao acessar ao site <a href='index.php'>xRayAID</a>, concorda em cumprir estes termos de serviço, todas as leis e regulamentos aplicáveis ​​e concorda que é responsável pelo cumprimento de todas as leis locais aplicáveis. Se você não concordar com algum desses termos, está proibido de usar ou acessar este site. Os materiais contidos neste site são protegidos pelas leis de direitos autorais e marcas comerciais aplicáveis.</p>\
                            &nbsp;\
                            <div class='card-header  rounded-lg border'>\
                                <h3 class='text-center font-weight-light my-2'>2. Uso de Licença</h3>\
                            </div>\
                            &nbsp;\
                            <p class='text-justify'>É concedida permissão para baixar temporariamente uma cópia dos materiais (informações ou software) no site xRayAID , apenas para visualização transitória pessoal e não comercial. Esta é a concessão de uma licença, não uma transferência de título e, sob esta licença, você não pode: </p>\
                            <ol>\
                                <li class='text-justify'>modificar ou copiar os materiais;  </li>\
                                <li class='text-justify'>usar os materiais para qualquer finalidade comercial ou para exibição pública (comercial ou não comercial);  </li>\
                                <li class='text-justify'>tentar descompilar ou fazer engenharia reversa de qualquer software contido no site xRayAID;  </li>\
                                <li class='text-justify'>remover quaisquer direitos autorais ou outras notações de propriedade dos materiais; ou  </li>\
                                <li class='text-justify'>transferir os materiais para outra pessoa ou 'espelhe' os materiais em qualquer outro servidor.</li>\
                            </ol>\
                            <p class='text-justify'>Esta licença será automaticamente rescindida se você violar alguma dessas restrições e poderá ser rescindida por xRayAID a qualquer momento. Ao encerrar a visualização desses materiais ou após o término desta licença, você deve apagar todos os materiais baixados em sua posse, seja em formato eletrónico ou impresso.</p>\
                            &nbsp;\
                            <div class='card-header  rounded-lg border'>\
                                <h3 class='text-center font-weight-light my-2'>3. Isenção de responsabilidade</h3>\
                            </div>\
                            &nbsp;\
                            <ol>\
                                <li class='text-justify'>Os materiais no site da xRayAID são fornecidos 'como estão'. xRayAID não oferece garantias, expressas ou implícitas, e, por este meio, isenta e nega todas as outras garantias, incluindo, sem limitação, garantias implícitas ou condições de comercialização, adequação a um fim específico ou não violação de propriedade intelectual ou outra violação de direitos. </li>\
                                &nbsp;\
                                <li class='text-justify'>Além disso, o xRayAID não garante ou faz qualquer representação relativa à precisão, aos resultados prováveis ​​ou à confiabilidade do uso dos materiais em seu site ou de outra forma relacionado a esses materiais ou em sites vinculados a este site.</li>\
                            </ol>\
                            &nbsp;\
                            <div class='card-header  rounded-lg border'>\
                                <h3 class='text-center font-weight-light my-2'>4. Limitações</h3>\
                            </div>\
                            &nbsp;\
                            <p class='text-justify'>Em nenhum caso o xRayAID ou seus fornecedores serão responsáveis ​​por quaisquer danos (incluindo, sem limitação, danos por perda de dados ou lucro ou devido a interrupção dos negócios) decorrentes do uso ou da incapacidade de usar os materiais em xRayAID, mesmo que xRayAID ou um representante autorizado da xRayAID tenha sido notificado oralmente ou por escrito da possibilidade de tais danos. Como algumas jurisdições não permitem limitações em garantias implícitas, ou limitações de responsabilidade por danos conseqüentes ou incidentais, essas limitações podem não se aplicar a você.</p>\
                            &nbsp;\
                            <div class='card-subtitle border'>\
                                <h4 class='text-center font-weight-light mt-2 my-2'>Precisão dos materiais</h4>\
                            </div>\
                            &nbsp;\
                            <p class='text-justify'>Os materiais exibidos no site da xRayAID podem incluir erros técnicos, tipográficos ou fotográficos. xRayAID não garante que qualquer material em seu site seja preciso, completo ou atual. xRayAID pode fazer alterações nos materiais contidos em seu site a qualquer momento, sem aviso prévio. No entanto, xRayAID não se compromete a atualizar os materiais.</p>\
                            &nbsp;\
                            <div class='card-header  rounded-lg border'>\
                                <h3 class='text-center font-weight-light my-2'>5. Links</h3>\
                            </div>\
                            &nbsp;\
                            <p class='text-justify'>O xRayAID não analisou todos os sites vinculados ao seu site e não é responsável pelo conteúdo de nenhum site vinculado. A inclusão de qualquer link não implica endosso por xRayAID do site. O uso de qualquer site vinculado é por conta e risco do usuário.</p>\
                            </p>\
                            &nbsp;\
                            <div class='card-subtitle border'>\
                                <h4 class='text-center font-weight-light mt-2 my-2'>Modificações</h4>\
                            </div>\
                            &nbsp;\
                            <p class='text-justify'>O xRayAID pode revisar estes termos de serviço do site a qualquer momento, sem aviso prévio. Ao usar este site, você concorda em ficar vinculado à versão atual desses termos de serviço.</p>\
                            &nbsp;\
                            <div class='card-subtitle border'>\
                                <h4 class='text-center font-weight-light mt-2 my-2'>Lei aplicável</h4>\
                            </div>\
                            &nbsp;\
                            <p class='text-justify'>Estes termos e condições são regidos e interpretados de acordo com as leis do xRayAID e você se submete irrevogavelmente à jurisdição exclusiva dos tribunais naquele estado ou localidade.</p> \
                            </div>\
                            <span class='close-terms d-flex justify-content-center'>&times;</br> </br></span>"
}