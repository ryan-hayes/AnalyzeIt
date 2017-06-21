# AnalyzeIt-Web
This was my capstone project for BIT 4454 at Virginia Tech. The primary use case of the project was to provide users with personalized product recommendations based on their page views on the site and purchase history. Core capabilities included keyword searching, filtering both inventory and recommendations, user account control, authentication, and real-time recommendation updates. 

Technology stack:
- Linux (Amazon version)
- Apache web server
- MySQL (on Amazon RDS)
- PHP
- Codeception (for PHP test cases and automated testing)
- Bootstrap (for responsiveness and styling)
- jQuery

Infrastructure (Amazon Web Services):
- EC2 - for running the application servers (Linux, Apache, PHP)
- RDS - for the dedicated (and isolated) MySQL database server
- CloudFront - content delivery network (for caching vehicle images)
- S3 - storage buckets (for holding on to static resources)
- QuickSight - business intelligence
- Route 53 - for routing between the mobile and web applications
