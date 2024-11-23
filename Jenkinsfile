pipeline {
    agent any

    stages {
        stage('Exibir Informações do Pipeline') {
            steps {
                script {
                    echo "Nome do Pipeline: ${env.JOB_NAME}"
                    echo "Workspace do Pipeline: ${env.WORKSPACE}"
                }
            }
        }
    }
}
