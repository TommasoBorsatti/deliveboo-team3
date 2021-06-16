new Vue({
        el: '#app',
        data: {
            category: '',
            restaurants: [],
            categories: [],
        },
        mounted:function(){
          
          axios.get('http://localhost:8000/api/restaurants')
          .then((result) => {
            this.categories = result.data;
          });
          
        },
        methods:{
            categoriesSearch: function() {
        let link = 'http://localhost:8000/api/restaurants'
        axios.get(link,{
            params: {
              category: this.category
            }
          }).then((result)=>{
              console.log(result.data);
            this.restaurants = result.data;
          });
        }
        }
    });
