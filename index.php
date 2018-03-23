
<?php get_header(); ?>




<div id="app">
<div class="inputbox">
<select class="select"  v-model="selected">
  <option v-for="option in options" v-bind:value="option.value">
    {{ option.text }}
  </option>
</select>
<input v-model="question" placeholder="find posts categoeries or author" type="text">
</div>
<div>
<span class="find-search-flash" v-html="answer"></span>	
</div>
<ul class="dropdown">
<li v-for="findval in getFindData">
	 <h2 class="mb-0">
	    <a :href="findval.link" v-text="findval.title"></a>
	  </h2>
	<small v-if="findval.count">
	      {{findval.count.text}}
	      {{findval.count.val}}
	  </small>
	<p v-html="findval.description"></p>
</li>
</ul>
</div>


<?php
wp_footer();?>


<script>

const app = new Vue({
    el: '#app',

  data: {
   
selected:'mypost',
options: [{ text: 'Posts', value: 'mypost' },
{ text: 'Categories', value: 'mycategory' },
{ text: 'Author', value: 'myauthor' }],
getfind:'',
question: '',
answer: 'just type and see',
getFindData:[],  
    
  },
  methods: {
    getAnswer: _.debounce(
      function () {



        if (this.question.indexOf('?') === -1) {
          this.answer = 'Questions usually contain a question mark. ;-)';
          getFindData =[];
         
      }

        this.answer = 'Wait';
        var self = this;

       //for extarnal doamin
//var wp = new WPAPI({ endpoint: 'http://your-domain/wp-json' }); 

// for intarnal domain 


var wp = new WPAPI({ endpoint: '/wp-json' });

wp.site = wp.registerRoute( 'myplugin/v1', '/find/id=(?P<id>)');

wp.site().id('?'+self.selected+'='+self.question)

       .then(function (response) {
            
          self.answer =  'for more details <a href="#" >click hear</a>';

         self.getFindData = JSON.parse(response['data']);
         
           
          })
          .catch(function (error) {
            self.answer = 'Error! Could not reach the API. ' + error;
            self.getFindData = [];
            console.log(error)
          })

        
      },
      // This is the number of milliseconds we wait for the
      // user to stop typing.
      500
    )

  },
   watch: {

selected: function(newQuestion, oldQuestion){
 this.getFindData = []; 
},

// whenever question changes, this function will run
    question: function (newQuestion, oldQuestion) {
     
      if (newQuestion.length>oldQuestion.length) {
      this.answer = 'Waiting for you to stop typing...';
      this.getAnswer();
      }else{
       this.getFindData = []; 
      }
     
    }
   },
});

</script>






	</body>
</html>







