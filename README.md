# PHP Assignment Project

## Requirements

- [Docker](https://www.docker.com/products/docker-desktop) (Please install Docker Desktop if you don't have it)

## Instructions

1. **Download the Project Files**
   - Download the project files from the provided link or repository.

2. **Open a Terminal or Command Prompt**
   - Open a terminal (macOS/Linux) or command prompt (Windows).

3. **Navigate to the Project Directory**
   - Use the `cd` command to navigate to the directory where you downloaded the project files. For example:

    "cd /path/to/php-assignment"
    
4. **Build the Docker Image**
   - Run the following command to build the Docker image:

    "docker build -t php-assignment ."
    

5. **Run the Docker Container**
   - Run the following command to start the Docker container:

    "docker run -p 8080:80 -d php-assignment"

6. **Access the PHP Application**
   - Open a web browser and go to [http://localhost:8080](http://localhost:8080). You should see the PHP application running.

## Stopping the Container

- To stop the Docker container, run:

"docker ps"

"docker stop <container_id>"
