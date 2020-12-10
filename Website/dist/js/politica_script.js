/*!
 * xRayAID
 * js/politica_script.js
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

/* Create the Variables */
var policy_div = document.getElementById("policy-content"); /* Get the div where the code below will be put */
var btn = document.getElementById("politica"); /* Get the button that opens the policy popup */

/* Functions */
btn.onclick = function add_modal() /* When click on "Politica de Privacidade" button, execute this script */ {
    /* Insert the Text on the model div */
    insert_policy_text()

    /* Declaring the rest os variables that was put on code above */
    modal = document.getElementById("text-politica");    /* Get policy model div element */
    span = document.getElementsByClassName("close")[0]; /* Get the button that closes the policy popup */

    /* And fade in the content */
    $("#text-politica").fadeIn('slow');
    modal.style.display = "block";

    /* Here, we are declaring the close function when X is presses on the policy model div */
    span.onclick = function () {
        modal.style.display = "none";
    }
}

function insert_policy_text() {
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
                            <span class='close d-flex justify-content-center'>&times;</br> </br></span>"
}