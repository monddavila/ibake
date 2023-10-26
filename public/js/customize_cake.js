<script>
        let index = 1
        let yourCakeBuild = {
            size:null,
            flavor:null,
            icing:null,
            filling:null,
            topBorder:null,
            bottomBorder:null,
            decorColor:null,
            message:null,
            price:null
        }
        
        $(document).ready(function(){

            $.fn.removeStyle = function(style)
            {
                var search = new RegExp(style + '[^;]+;?', 'g');

                return this.each(function()
                {
                    $(this).attr('style', function(i, style)
                    {
                        return style && style.replace(search, '');
                    });
                });
            };
            $('#slide1 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide1 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.size = $(this).find('.size-label').html()
                    yourCakeBuild.price = $(this).find('.cake-price').html()
                })
            })
            $('#slide2 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide2 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.flavor = $(this).find('.cake-flavor').html().trim()
                    if(yourCakeBuild.flavor=='Moist Chocolate'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#C38154"; //brown
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.flavor=='Carrot Walnut'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#FF9B50 "; // orange
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        //2nd Step Start code block - teammed//
                    } else if(yourCakeBuild.flavor=='Ube'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#D988B9";//purple
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        //2nd Step code block end - teammed//
                    } else if(yourCakeBuild.flavor=='Yema'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#FFDBAA";//peach
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.flavor=='Red Velvet'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#E76161";//red
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                    } 
                })
            })
            $('#slide3 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide3 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.filling = $(this).find('.cake-filling').html().trim()
                    if(yourCakeBuild.filling=='Chocolate Buttercream'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#E2C799";//light choco
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#E2C799";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                        // yourCakeBuild.price = parseInt(yourCakeBuild.price.replace("PHP","")) + 1000 + "PHP"
                    } else if(yourCakeBuild.filling=='Chocolate Ganache'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#65451F";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#65451F";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.filling=='Cream Cheese'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#FFEECC";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#FFEECC";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    }else if(yourCakeBuild.filling=='Ube'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#7A316F";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#7A316F";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.filling=='Vanilla'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#FAF3F0";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#FAF3F0";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.filling=='White Chocolate'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#EADBC8";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#EADBC8";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.filling=='Yema'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#F5F0BB";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#F5F0BB";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.filling=='Cheese'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#F4CE14";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#F4CE14";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    }
                })
            })
            $('#slide4 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide4 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.icing = $(this).find('.cake-icing').html().trim()
                    if(yourCakeBuild.icing=='Red'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "FireBrick";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Light Blue'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "LightSkyBlue";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Lavender'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "Lavender";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Peach'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "PeachPuff";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Lemon Yellow'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "yellow";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Teal'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "Cyan";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Orange'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "orange";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide5 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide5 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.topBorder = $(this).find('.cake-top-border').html().trim()
                    if(yourCakeBuild.topBorder=='Light Red'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "IndianRed";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Light Pink'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "LightPink";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Orange'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "coral";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Purple'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "purple";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Brown'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "brown";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Sky Blue'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "deepskyblue";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Blue'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "Blue";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Cream'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "AntiqueWhite";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide6 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide6 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.bottomBorder = $(this).find('.cake-bottom-border').html().trim()
                    if(yourCakeBuild.bottomBorder=='Light Red'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "IndianRed";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Light Pink'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "lightpink";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Orange'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "Coral";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Purple'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "purple";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Brown'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "brown";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Sky Blue'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "DeepSkyBlue";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Blue'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "blue";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Cream'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "AntiqueWhite";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide7 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide7 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    $('#decors').removeClass('d-none')
                    yourCakeBuild.decorColor = $(this).find('.cake-flower-color').html().trim()
                    if(yourCakeBuild.decorColor=='Blue'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "DodgerBlue";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Cream'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "Wheat";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Yellow'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "yellow";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Pink'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "pink";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Red'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "Salmon";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Orange'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "Tomato";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Purple'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "DarkViolet";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='None'){
                        $('#decors').addClass('d-none')
                        // var cssVariableName = "--flower-bg";
                        // var cssVariableValue = "yellow";
                        // document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide8 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide8 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.message = $(this).find('.cake-message').html().trim()
                    if(yourCakeBuild.message=='None'){
                        yourCakeBuild.message = 'None'
                        $('#cake-message').val('')
                        $('#cake-message').prop('readonly',true)
                    } 
                })
            })

            $('#cake-message').on('click',function(){
                $(this).prop('readonly',false)
            })
            $('#cake-message').on('change',function(){
                yourCakeBuild.message = $(this).val()
            })

            $('#nextStep').on('click',function(){
                if(index==1) {
                    if(yourCakeBuild.size==null) return
                } else if(index==2) {
                    if(yourCakeBuild.flavor==null) return
                } else if(index==3) {
                    if(yourCakeBuild.filling==null) return
                } else if(index==4) {
                    if(yourCakeBuild.icing==null) return
                } else if(index==5) {
                    if(yourCakeBuild.topBorder==null) return
                } else if(index==6) {
                    if(yourCakeBuild.bottomBorder==null) return
                } else if(index==7) {
                    if(yourCakeBuild.decorColor==null) return
                }
                
                if(index==8) {
                    if(yourCakeBuild.message==null) return
                    $('.steps-buttons').addClass('d-none')
                    $('.steps-buttons').removeClass('d-flex')
                    $('.go-back').removeClass('d-none')
                    $('.go-back').addClass('d-flex')
                    $('.cakeSummary').removeClass('d-none')
                    $('.steps').each(function(i,el){
                        $(this).addClass('d-none')
                    })
                    // Cake Customized order summary data
                    $('#cakeSize').html('Size: ' +yourCakeBuild.size)
                    $('#cakeSizeval').val(yourCakeBuild.size)

                    $('#cakeFlavor').html('Flavor: ' +yourCakeBuild.flavor)
                    $('#cakeFlavorval').val(yourCakeBuild.flavor)

                    $('#cakeFilling').html('Filling: ' +yourCakeBuild.filling)
                    $('#cakeFillingval').val(yourCakeBuild.filling)

                    $('#cakeIcing').html('Icing: ' +yourCakeBuild.icing)
                    $('#cakeIcingval').val(yourCakeBuild.icing)

                    $('#cakeTopBorder').html('Top Border: ' +yourCakeBuild.topBorder)
                    $('#cakeTopBorderval').val(yourCakeBuild.topBorder)

                    $('#cakeBottomBorder').html('Bottom Border: ' +yourCakeBuild.bottomBorder)
                    $('#cakeBottomBorderval').val(yourCakeBuild.bottomBorder)

                    if(yourCakeBuild.decorColor == 'None') {
                        $('#cakeDecoration').html('Decoration: ' +yourCakeBuild.decorColor)
                        $('#cakeDecorationval').val(yourCakeBuild.decorColor)
                    } else {
                        $('#cakeDecoration').html('Decoration: ' +yourCakeBuild.decorColor+ ' Flower')
                        $('#cakeDecorationval').val(yourCakeBuild.decorColor+ ' Flower')
                    }

                    $('#cakeMessage').html('Message: ' +yourCakeBuild.message)
                    $('#cakeMessageval').val(yourCakeBuild.message)

                    $('#cakePrice').html(yourCakeBuild.price)
                    $('#cakePriceval').val(yourCakeBuild.price)

                }
                index++
                $('.steps').each(function(i,el){
                    if(i==index-1) {
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                        
                    }
                })
                $('#currentStep').html(index)
            })
            $('#prevStep').on('click',function(){
                if(index==1) return
                index--
                $('.steps').each(function(i,el){
                    if(i==index-1) {
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                    }
                })
                $('#currentStep').html(index)
            })

            $('#editChoices').on('click',function(){
                index = 1
                $('.go-back').addClass('d-none')
                $('.go-back').removeClass('d-flex')
                $('.steps-buttons').removeClass('d-none')
                $('.steps-buttons').addClass('d-flex')
                $('#currentStep').html(index)
                $('.cakeSummary').addClass('d-none')
                $('.steps').each(function(i,el){
                    if(i==index-1) {
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                    }
                })
            })
        })
    </script>