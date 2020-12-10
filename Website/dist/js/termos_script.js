/*!
 * xRayAID
 * js/termos_script.js
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

/* Create the Variables */
var term_div = document.getElementById("terms-content") /* Get the div where the code below will be put */
var btn_termos = document.getElementById("termos");     /* Get the button that opens the termos popup */

/* Functions */
btn_termos.onclick = function () /* When click on "Termos de Uso" button, execute this script */ {
    /* Insert the Text on the model div */
    insert_terms_text()

    /* Declaring the rest os variables that was put on code above */
    termos = document.getElementById("text-termos");    /* Get termos model div element */
    span_terms = document.getElementsByClassName("close-terms")[0]; /* Get the button that closes the termos popup */

    /* And fade in the content */
    $("#text-termos").fadeIn('slow');
    termos.style.display = "block";

    /* Here, we are declaring the close function when X is presses on the terms model div */
    span_terms.onclick = function () {
        termos.style.display = "none";
    }
}

function insert_terms_text() {
    /* Insert the Text on the model div */
    term_div.innerHTML = "<div class='card-header  rounded-lg border'> \
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