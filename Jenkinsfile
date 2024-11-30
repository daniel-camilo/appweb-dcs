pipeline {
    agent any

    environment {
        CONTAINER_NAME = "appweb"
    }

    stages {
        stage("Build Image") {
            steps {
                script {
                    sh """
                    echo "O nome da aplicação é: ${env.CONTAINER_NAME}"
                    pwd
                    ls -lha
                    """
                    // dockerImage = docker.build("harbor.dcwork.com.br/appweb-vbox/appweb-jks:${env.BUILD_ID}", "-f ${WORKSPACE}/Dockerfile ${WORKSPACE}/src")
                }
            }
        }

        /*
        stage("Push Docker Image") {
            steps {
                script {
                    docker.withRegistry("https://harbor.dcwork.com.br", "harbor_credential") {
                        dockerImage.push()
                    }
                }
            }
        }

        stage("Clean Up Existing Container") {
            steps {
                script {
                    // Verifica se o conatiner está em execução e o remove:
                    sh """
                    if [ \$(docker ps -aq -f name=${CONTAINER_NAME}) ]; then
                        docker stop ${CONTAINER_NAME} || true
                        docker rm ${CONTAINER_NAME} || true
                    fi
                    """
                }
            }
        }

        stage("Deploy Application") {
            steps {
                script {
                    docker.withRegistry("https://harbor.dcwork.com.br", "harbor_credential") {
                        def appContainer = docker.image("harbor.dcwork.com.br/appweb-vbox/appweb-jks:${env.BUILD_ID}")
                        appContainer.run("-d -p 9092:80 --name ${CONTAINER_NAME}")
                    }
                }
            }
        }
        */
    }
}
