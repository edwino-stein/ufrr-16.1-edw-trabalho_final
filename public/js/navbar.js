jQuery(document).ready(function(){

    navbar = {
        inited: false,
        $root: $('.navbar'),
        $links: $('#navbar-links-container'),
        $linksDropdown: $('#navbar-links-container .dropdown'),
        itens:[],
        hidden:[],

        init: function(){

            if(this.$root.width() <= 767 || this.inited) return;

            navbar.$links.children().each(function(index, item){
                item = $(item);
                if(item.hasClass('dropdown')) return;

                navbar.itens.push({
                    index: index,
                    item: item,
                    width: item.width()
                });

                item.attr('item-index', index);
            });

            this.inited = true;
            navbar.onRezie();
            navbar.$links.css('position', 'initial');
        },

        getUsefulSpace: function(){
            return this.$root.width() - ($('#navbar-cart').width() + $('#navbar-search').width() + $('.navbar-header').width() + 30);
        },

        onRezie: function(){

            if(this.$root.width() <= 767) return;
            this.init();

            var width = this.getUsefulSpace();
            var linksW = this.$links.width() + 40;

            if(linksW > width){
                do{
                    var last = this.itens.pop();
                    this.$linksDropdown.find('ul').prepend(last.item);
                    this.hidden.unshift(last);

                    width = this.getUsefulSpace();
                    linksW = this.$links.width() + 40;
                }while(linksW > width && this.itens.length > 0);
            }
            else if(linksW + this.itens[this.itens.length - 1].width < width && this.hidden.length > 0){
                do{
                    var first = this.hidden.shift();
                    this.$linksDropdown.before(first.item);
                    this.itens.push(first);

                    width = this.getUsefulSpace();
                    linksW = this.$links.width() + 40;
                }while(linksW + this.itens[this.itens.length - 1].width < width && this.hidden.length > 0)
            }

            if(this.hidden.length <= 0){
                this.$linksDropdown.hide();
            }
            else{
                this.$linksDropdown.show();
            }
        }
    }

    var xs = navbar.$links.clone().attr('id', '').addClass('visible-xs');
    xs.css('position', 'initial').find('.dropdown').remove();
    navbar.$links.addClass('hidden-xs').after(xs);
    navbar.init();
    $(window).resize(function(){navbar.onRezie()});
});
