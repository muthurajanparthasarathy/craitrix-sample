$(document).ready(function () {
  const stories = [
    {
      title: "Game Changer",
      text: "Sarah’s team struggled with project management inefficiencies. After adopting our SaaS platform, collaboration improved, and project completion time decreased by 40%.",
      image: "./images/1000_F_613680305_mvc4PTHJo4Dc9ZCGkVG0TQ56pxXCnyfS.jpg"
    },
    {
      title: "Great Experience",
      text: "Mark's company faced challenges in data management. Our cloud-based solution helped streamline operations, reducing manual efforts by 50% and increasing efficiency.",
      image: "./images/depositphotos_649178250-stock-photo-smiling-young-man-studio-photo.jpg"
    },
    {
      title: "Amazing Results",
      text: "Lisa, a small business owner, improved customer retention by 35% after integrating our AI-driven analytics platform. Now, she personalizes experiences effortlessly.",
      image: "./images/pexels-photo-2379004.jpeg"
    }
  ];

  let currentIndex = 0;

  function updateStory() {
    currentIndex = (currentIndex + 1) % stories.length;

    $("#storyTitle").text(stories[currentIndex].title);
    $("#storyText").text(stories[currentIndex].text);
    $("#storyImage").attr("src", stories[currentIndex].image);
  }

  setInterval(updateStory, 5000); // Change story every 5 seconds





  const processSteps = [
    { title: "Step 1: Research", description: "We gather data, analyze requirements, and understand project goals before proceeding." },
    { title: "Step 2: Planning", description: "We create a detailed roadmap, define milestones, and allocate resources effectively." },
    { title: "Step 3: Design", description: "We create wireframes, UI/UX designs, and user-friendly layouts." },
    { title: "Step 4: Development", description: "We start coding, integrating functionalities, and building a scalable system." },
    { title: "Step 5: Deployment", description: "We launch the product, monitor performance, and optimize as needed." }
  ];

  $(".process-list div").click(function () {
    let index = $(this).data("index");

    // Update content
    $("#processTitle").text(processSteps[index].title);
    $("#processDescription").text(processSteps[index].description);

    // Remove active class and add to the clicked item
    $(".process-list div").removeClass("active");
    $(this).addClass("active");

    // Apply animation
    $(".process-details").removeClass("fade-in");
    setTimeout(() => $(".process-details").addClass("fade-in"), 10);
  });


  $(".faq-question").click(function () {
    let answerId = $(this).data("answer");
    let icon = $(this).find("i");

    // Close other open answers
    $(".faq-answer").not("#" + answerId).slideUp();
    $(".faq-question i").not(icon).removeClass("fa-minus").addClass("fa-plus");

    // Toggle selected answer
    $("#" + answerId).slideToggle();
    icon.toggleClass("fa-plus fa-minus");
  });



  const $cards = $(".feature-card");
  const $features = $(".features"); // Select the parent container
  const $featureHeader = $(".feature-header"); // Select the header
  const colors = ["#FFFFFF", "#EDf7F2", "#fefbf5", "#F9EDF7", "#F7F9ED", '#EDF3F9']; // Define background colors

  function updateStickyCards() {
    let scrollPosition = $(window).scrollTop() + $(window).height();
    console.log("scrollPosition"+scrollPosition);
    let activeIndex = -1;

    $cards.each(function (index) {
      let $card = $(this);
      let cardTop = $card.offset().top;
      let cardBottom = cardTop + $card.outerHeight();
      console.log("cardBottom"+cardBottom);

      if (scrollPosition > cardBottom) {
        $card.addClass("show");
        $card.css({
          "position": "sticky",
          "top": `${index * 30 + 160}px`,
          "z-index": index + 10
        });

        activeIndex = index; // Update active index based on scroll
      } else {
        $card.removeClass("show");
      }
    });

    // Change the background color of .features based on active card index
    if (activeIndex >= 0) {
      $features.css("background-color", colors[activeIndex % colors.length]);
    } else {
      $features.css("background-color", ""); // Reset to default if no card is active
    }

    // Remove sticky from .feature-header when the 5th card is reached
    if (activeIndex >= 5) {
      $featureHeader.css("position", "static");
    } else {
      $featureHeader.css("position", "sticky");
    }
  }

  // $(window).on("scroll", updateStickyCards);
  // updateStickyCards();

  // const options = {
  //   root: null,
  //   rootMargin: "0px",
  //   threshold: 0.5
  // };

  // const observer = new IntersectionObserver(function (entries) {
  //   entries.forEach(function (entry) {
  //     const iconId = $(entry.target).data('icon-id');
  //     const $icon = $(`.feature-icon[data-icon-id="${iconId}"]`);

  //     if (entry.isIntersecting) {
  //       $icon.addClass('active-icon').removeClass('dim-icon');
  //       $('.feature-icon').not($icon).addClass('dim-icon');
  //     } else {
  //       $icon.removeClass('active-icon dim-icon');
  //     }
  //   });
  // }, options);

  // $('.feature-card').each(function () {
  //   observer.observe(this);
  // });



  $(".faq-answer:first").show().addClass("active");

  $(".faq-question").click(function () {
    var answerId = $(this).data("answer");

    // Remove the active class from all questions and add to the selected one
    $(".faq-question").removeClass("active");
    $(this).addClass("active");

    // Hide all answers, then show the selected one with animation
    $(".faq-answer").removeClass("active").slideUp(300);
    $("#" + answerId).slideDown(300).addClass("active");
  });
  $(document).ready(function () {
    $('#contact-method').change(function () {
      var selectedMethod = $(this).val();

      // Change the placeholder based on selected method
      if (selectedMethod === 'whatsapp') {
        $('#phone').attr('placeholder', 'Your WhatsApp number');
      } else if (selectedMethod === 'telegram') {
        $('#phone').attr('placeholder', 'Your Telegram number');
      } else if (selectedMethod === 'skype') {
        $('#phone').attr('placeholder', 'Your Skype ID');
      } else {
        $('#phone').attr('placeholder', 'Enter your contact number');
      }
    });
  });



  // let steps = ['#step1', '#step2', '#step3', '#step4', '#step5'];
  // let currentStep = 0;

  // function highlightStep(step) {
  //   $(step).addClass('highlighted');
  // }

  // function removeHighlight(step) {
  //   $(step).removeClass('highlighted');
  // }

  // function animateSteps() {
  //   // Remove highlight from all steps
  //   steps.forEach(step => removeHighlight(step));

  //   // Highlight current step
  //   highlightStep(steps[currentStep]);

  //   // Increment to the next step
  //   currentStep++;

  //   // Reset when all steps are completed
  //   if (currentStep >= steps.length) {
  //     currentStep = 0;
  //   }
  // }

  // Start highlighting steps one by one every 2 seconds
  // setInterval(animateSteps, 2000);
   steps = $(".step");
  let processTitle = $("#processTitle");
  let processDescription = $("#processDescription");

  let stepDetails = [
      { title: "Ideation", description: "Brainstorming fresh ideas and defining the core problem your business aims to solve." },
      { title: "Research", description: "Digging deep into market trends, competitor strategies, and validating a proper business solution." },
      { title: "Planning", description: "Structuring the roadmap, setting milestones, and aligning resources to ensure smooth execution." },
      { title: "Design", description: "Crafting user-friendly interfaces and interactive mockups to visualize the final product." },
      { title: "Development", description: "Writing clean, efficient code while integrating features and ensuring system functionality." },
      { title: "Testing", description: "Identifying bugs, gathering feedback, and refining the product for a seamless user experience." }
  ];

   currentStep = 0;
  let interval;

  function updateStep(index) {
      steps.removeClass("active"); // Remove active from all
      steps.eq(index).addClass("active"); // Add active to the new step
      
      processTitle.text(stepDetails[index].title);
      processDescription.text(stepDetails[index].description);

      currentStep = index;
  }

  function nextStep() {
      let nextIndex = (currentStep + 1) % steps.length;
      updateStep(nextIndex);
  }

  function startAutoProgress() {
      clearInterval(interval); // Clear previous interval
      interval = setInterval(nextStep, 3000);
  }

  steps.each(function (index) {
      $(this).click(function () {
          clearInterval(interval);
          updateStep(index);
          startAutoProgress();
      });
  });

  updateStep(currentStep);
  startAutoProgress();
  const testimonials = [
    {
        author: "Brandon Turp",
        stars: "★★★★★",
        text: "&nbsp;&nbsp;&nbsp;Our Experience with Craitrix was really great and happy to associate with them. They create perfect solution for my business needs and the support they provide was nice and highly recommend"
    },
    {
        author: "Hormozi Eparphra",
        stars: "★★★★☆",
        text: "&nbsp;&nbsp;&nbsp;Our partnership with Craitrix is a right decision made and the blockchain services delivered was exceptional and looking forward for a long term collaboration"
    },
    {
        author: "Bailey Theo",
        stars: "★★★★★",
        text: "&nbsp;&nbsp;&nbsp;The team understood and built our application as per our requirements and had a collaborative team and highly responsive for our feedback and provide back to back and immediate support to maintain our app updated in the market."
    }
];

  currentIndex = 0;

  function updateTestimonial(index) {
    document.getElementById("authorName").textContent = testimonials[index].author;
    document.querySelector(".stars").innerHTML = testimonials[index].stars;

    document.getElementById("testimonialText").innerHTML = testimonials[index].text;
  }

  document.getElementById("nextBtn").addEventListener("click", function () {
    currentIndex = (currentIndex + 1) % testimonials.length;
    updateTestimonial(currentIndex);
  });

  document.getElementById("prevBtn").addEventListener("click", function () {
    currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
    updateTestimonial(currentIndex);
  });

});













