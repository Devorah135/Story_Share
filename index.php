<!DOCTYPE html>
<?php include "header.php"; ?>

<LINK rel='stylesheet' href='ResponsiveSlides.js-master/responsiveslides.css' type='text/css' />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <script src="ResponsiveSlides.js-master/responsiveslides.min.js"></script>

<style>
    #container{
        display: flex;
        flex-direction: row;
        align-items: stretch;
    }
    
    #content {
       flex: 1;
       padding: 20px;
       width: 30vw;
    }
    div#slideshow {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70vw;
    }
</style>

        <h1>Welcome to StoryShare!</h1>
        
        <div id="container">
            <div id="content">
            <p>
                At StoryShare, educators can find stories to add to any lessons. 
                Sorted by topic, the stories are clear, well-written, and will make 
                your classroom come alive. Start by searching for a story for any 
                topic you'd like, or check out our featured stories.
            </p>
            <p>
                Enjoyed using StoryShare? Benefited from the stories that helped your 
                students apply the lesson? Help our others! Share your story so that 
                educators (or anyone who needs a good story!) can benefit from yours.
            </p>
            <p>
                    Our collection of stories is continually growing, thanks to contributions from educators like you. 
                   If you have a favorite story or a lesson that has made an impact in your classroom, consider sharing it 
                    with our community. By doing so, you’re helping to create a rich resource that supports teaching and 
                    learning across diverse subjects and grade levels.
                </p>
                
                <p>
                    At StoryShare, we believe that great stories can spark curiosity, inspire creativity, and enhance the 
                    learning experience. Whether you're a teacher looking for the perfect story to complement your lesson plan 
                    or a parent seeking engaging content for your child's education, our platform is designed to provide a 
                    wide array of stories that meet your needs. Join us in our mission to make storytelling an integral part 
                    of education.
                 </p>

            </div>

            <div id="slideshow">
            <ul class="rslides">
                <li><img src="1.jpg" alt="slider image"></li>
                <li><img src="2.png" alt="slider image"></li>
                <li><img src="3.jpg" alt="slider image"></li>
            </ul>

            <script>
            $(function() {
                 $(".rslides").responsiveSlides({  
                     auto: true,          
                     speed: 500,           
                     timeout: 4000,         
                     pager: false,           
                     nav: false,   
                     pause: true
                    })
                });
            </script>

            </div>
        </div>
<?php include "footer.php"; ?>
