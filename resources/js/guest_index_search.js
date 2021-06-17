new Vue({
        el: '#app',
        data: {
            category: '',
            categoryName: '' ,
            restaurants: [],
            categories: [],
            images: [
              'storage/images/rist1.jpg',
              'storage/images/rist2.jpg', 
              'storage/images/rist3.jpg',
              'storage/images/rist4.jpg',
              'storage/images/rist5.jpg'            
            ],
            
        },

        mounted:function(){
          
          axios.get('http://localhost:8000/api/restaurants-cat')
          .then((result) => {
            this.categories = result.data;
          });
          
        },
        methods:{
            categoriesSearch: function( index, categoryName ) {
            
            this.categoryName = categoryName;

            let link = 'http://localhost:8000/api/restaurants'
            axios.get(link,{
                params: {
                  category: index + 1
                }
              }).then((result)=>{
                  console.log(result.data);
                this.restaurants = result.data;
            });
        }
        }
    });
