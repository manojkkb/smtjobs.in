<?php

namespace Database\Seeders;

use App\Models\Skill;

class SkillSeeder extends MasterSeeder
{
    public function run(): void
    {
       $skills = [

    // Programming Languages
    ['slug' => 'python', 'label' => 'Python'],
    ['slug' => 'java', 'label' => 'Java'],
    ['slug' => 'c', 'label' => 'C'],
    ['slug' => 'cpp', 'label' => 'C++'],
    ['slug' => 'csharp', 'label' => 'C#'],
    ['slug' => 'go', 'label' => 'Go'],
    ['slug' => 'rust', 'label' => 'Rust'],
    ['slug' => 'kotlin', 'label' => 'Kotlin'],
    ['slug' => 'swift', 'label' => 'Swift'],
    ['slug' => 'r', 'label' => 'R'],
    ['slug' => 'scala', 'label' => 'Scala'],
    ['slug' => 'groovy', 'label' => 'Groovy'],
    ['slug' => 'cobol', 'label' => 'COBOL'],
    ['slug' => 'perl', 'label' => 'Perl'],
    ['slug' => 'abap', 'label' => 'ABAP'],

    // Frontend
    ['slug' => 'html', 'label' => 'HTML'],
    ['slug' => 'css', 'label' => 'CSS'],
    ['slug' => 'javascript', 'label' => 'JavaScript'],
    ['slug' => 'typescript', 'label' => 'TypeScript'],
    ['slug' => 'react', 'label' => 'React'],
    ['slug' => 'angular', 'label' => 'Angular'],
    ['slug' => 'vue', 'label' => 'Vue.js'],
    ['slug' => 'nextjs', 'label' => 'Next.js'],
    ['slug' => 'redux', 'label' => 'Redux'],
    ['slug' => 'bootstrap', 'label' => 'Bootstrap'],
    ['slug' => 'jquery', 'label' => 'jQuery'],
    ['slug' => 'responsive-design', 'label' => 'Responsive Design'],
    ['slug' => 'webpack', 'label' => 'Webpack'],

    // Backend
    ['slug' => 'nodejs', 'label' => 'Node.js'],
    ['slug' => 'spring-boot', 'label' => 'Spring Boot'],
    ['slug' => 'spring', 'label' => 'Spring'],
    ['slug' => 'django', 'label' => 'Django'],
    ['slug' => 'laravel', 'label' => 'Laravel'],
    ['slug' => 'aspnet', 'label' => 'ASP.NET'],
    ['slug' => 'express', 'label' => 'Express.js'],
    ['slug' => 'fastapi', 'label' => 'FastAPI'],
    ['slug' => 'hibernate', 'label' => 'Hibernate'],
    ['slug' => 'rest-api', 'label' => 'REST API'],
    ['slug' => 'graphql', 'label' => 'GraphQL'],

    // Databases
    ['slug' => 'mysql', 'label' => 'MySQL'],
    ['slug' => 'postgresql', 'label' => 'PostgreSQL'],
    ['slug' => 'mongodb', 'label' => 'MongoDB'],
    ['slug' => 'oracle', 'label' => 'Oracle'],
    ['slug' => 'sql-server', 'label' => 'SQL Server'],
    ['slug' => 'redis', 'label' => 'Redis'],
    ['slug' => 'cassandra', 'label' => 'Cassandra'],
    ['slug' => 'dynamodb', 'label' => 'DynamoDB'],
    ['slug' => 'snowflake', 'label' => 'Snowflake'],
    ['slug' => 'bigquery', 'label' => 'BigQuery'],
    ['slug' => 'plsql', 'label' => 'PL/SQL'],
    ['slug' => 'nosql', 'label' => 'NoSQL'],

    // Cloud & DevOps
    ['slug' => 'aws', 'label' => 'AWS'],
    ['slug' => 'azure', 'label' => 'Microsoft Azure'],
    ['slug' => 'gcp', 'label' => 'Google Cloud'],
    ['slug' => 'docker', 'label' => 'Docker'],
    ['slug' => 'kubernetes', 'label' => 'Kubernetes'],
    ['slug' => 'terraform', 'label' => 'Terraform'],
    ['slug' => 'jenkins', 'label' => 'Jenkins'],
    ['slug' => 'ci-cd', 'label' => 'CI/CD'],
    ['slug' => 'devops', 'label' => 'DevOps'],
    ['slug' => 'cloudformation', 'label' => 'CloudFormation'],
    ['slug' => 'lambda', 'label' => 'AWS Lambda'],
    ['slug' => 's3', 'label' => 'Amazon S3'],
    ['slug' => 'ec2', 'label' => 'Amazon EC2'],
    ['slug' => 'rds', 'label' => 'Amazon RDS'],

    // AI / ML
    ['slug' => 'machine-learning', 'label' => 'Machine Learning'],
    ['slug' => 'deep-learning', 'label' => 'Deep Learning'],
    ['slug' => 'artificial-intelligence', 'label' => 'Artificial Intelligence'],
    ['slug' => 'tensorflow', 'label' => 'TensorFlow'],
    ['slug' => 'pytorch', 'label' => 'PyTorch'],
    ['slug' => 'scikit-learn', 'label' => 'Scikit-learn'],
    ['slug' => 'pandas', 'label' => 'Pandas'],
    ['slug' => 'numpy', 'label' => 'NumPy'],
    ['slug' => 'spark', 'label' => 'Apache Spark'],
    ['slug' => 'nlp', 'label' => 'Natural Language Processing'],
    ['slug' => 'llms', 'label' => 'LLMs'],
    ['slug' => 'rag', 'label' => 'RAG'],

    // Testing
    ['slug' => 'selenium', 'label' => 'Selenium'],
    ['slug' => 'junit', 'label' => 'JUnit'],
    ['slug' => 'testng', 'label' => 'TestNG'],
    ['slug' => 'cypress', 'label' => 'Cypress'],
    ['slug' => 'postman', 'label' => 'Postman'],
    ['slug' => 'jmeter', 'label' => 'JMeter'],
    ['slug' => 'pytest', 'label' => 'PyTest'],
    ['slug' => 'automation-testing', 'label' => 'Automation Testing'],
    ['slug' => 'manual-testing', 'label' => 'Manual Testing'],

    // Management & Business
    ['slug' => 'project-management', 'label' => 'Project Management'],
    ['slug' => 'agile', 'label' => 'Agile'],
    ['slug' => 'scrum', 'label' => 'Scrum'],
    ['slug' => 'kanban', 'label' => 'Kanban'],
    ['slug' => 'product-management', 'label' => 'Product Management'],
    ['slug' => 'business-analysis', 'label' => 'Business Analysis'],
    ['slug' => 'sales', 'label' => 'Sales'],
    ['slug' => 'digital-marketing', 'label' => 'Digital Marketing'],
    ['slug' => 'seo', 'label' => 'SEO'],
    ['slug' => 'crm', 'label' => 'CRM'],
    ['slug' => 'accounting', 'label' => 'Accounting'],
    ['slug' => 'financial-analysis', 'label' => 'Financial Analysis'],

    ['slug' => 'system-design', 'label' => 'System Design'],
    ['slug' => 'system-architecture', 'label' => 'System Architecture'],
    ['slug' => 'microservices-architecture', 'label' => 'Microservices Architecture'],
    ['slug' => 'distributed-systems', 'label' => 'Distributed Systems'],
    ['slug' => 'event-driven-architecture', 'label' => 'Event Driven Architecture'],
    ['slug' => 'domain-driven-design', 'label' => 'Domain Driven Design'],
    ['slug' => 'scalability', 'label' => 'Scalability'],
    ['slug' => 'high-availability', 'label' => 'High Availability'],

    ['slug' => 'api-development', 'label' => 'API Development'],
    ['slug' => 'api-integration', 'label' => 'API Integration'],
    ['slug' => 'api-design', 'label' => 'API Design'],
    ['slug' => 'api-management', 'label' => 'API Management'],
    ['slug' => 'restful-services', 'label' => 'RESTful Services'],
    ['slug' => 'soap-apis', 'label' => 'SOAP APIs'],
    ['slug' => 'swagger', 'label' => 'Swagger'],
    ['slug' => 'oauth2', 'label' => 'OAuth2'],
    ['slug' => 'sso', 'label' => 'Single Sign-On (SSO)'],

     ['slug' => 'containerization', 'label' => 'Containerization'],
    ['slug' => 'infrastructure-as-code', 'label' => 'Infrastructure as Code'],
    ['slug' => 'cloud-architecture', 'label' => 'Cloud Architecture'],
    ['slug' => 'cloud-security', 'label' => 'Cloud Security'],
    ['slug' => 'observability', 'label' => 'Observability'],
    ['slug' => 'monitoring', 'label' => 'Monitoring'],

    ['slug' => 'generative-ai', 'label' => 'Generative AI'],
    ['slug' => 'prompt-engineering', 'label' => 'Prompt Engineering'],
    ['slug' => 'agentic-ai', 'label' => 'Agentic AI'],
    ['slug' => 'vector-databases', 'label' => 'Vector Databases'],
    ['slug' => 'transformers', 'label' => 'Transformers'],
    ['slug' => 'langchain', 'label' => 'LangChain'],
    ['slug' => 'llamaindex', 'label' => 'LlamaIndex'],
    ['slug' => 'mlflow', 'label' => 'MLflow'],

      ['slug' => 'data-governance', 'label' => 'Data Governance'],
    ['slug' => 'risk-management', 'label' => 'Risk Management'],
    ['slug' => 'iso-27001', 'label' => 'ISO 27001'],
    ['slug' => 'iso-9001', 'label' => 'ISO 9001'],
    ['slug' => 'gdpr', 'label' => 'GDPR'],
    ['slug' => 'hipaa', 'label' => 'HIPAA'],
    ['slug' => 'regulatory-compliance', 'label' => 'Regulatory Compliance'],

     ['slug' => 'product-strategy', 'label' => 'Product Strategy'],
    ['slug' => 'roadmapping', 'label' => 'Roadmapping'],
    ['slug' => 'user-stories', 'label' => 'User Stories'],
    ['slug' => 'a-b-testing', 'label' => 'A/B Testing'],
    ['slug' => 'growth-hacking', 'label' => 'Growth Hacking'],

     ['slug' => 'sap-s4-hana', 'label' => 'SAP S/4 HANA'],
    ['slug' => 'sap-btp', 'label' => 'SAP BTP'],
    ['slug' => 'oracle-erp', 'label' => 'Oracle ERP'],
    ['slug' => 'netsuite', 'label' => 'NetSuite'],
    ['slug' => 'salesforce-service-cloud', 'label' => 'Salesforce Service Cloud'],

     ['slug' => 'performance-optimization', 'label' => 'Performance Optimization'],
    ['slug' => 'load-testing', 'label' => 'Load Testing'],
    ['slug' => 'memory-optimization', 'label' => 'Memory Optimization'],
    ['slug' => 'code-optimization', 'label' => 'Code Optimization'],

];
// Upsert skills upload in chunks to avoid memory issues
$chunkSize = 100;
foreach (array_chunk($skills, $chunkSize) as $chunkskills) {
    
        $this->upsertRecords(
            Skill::class,
            $chunkskills
        );
    

}
    }
}
