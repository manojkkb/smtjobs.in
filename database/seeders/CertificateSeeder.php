<?php

namespace Database\Seeders;

use App\Models\Certificate;

class CertificateSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Certificate::class, [

        /* ================= IT & CLOUD ================= */
        ['slug'=>'aws-solutions-architect','label'=>'AWS Certified Solutions Architect','category'=>'it_cloud','issuing_authority'=>'Amazon','icon'=>'aws','sort_order'=>1],
        ['slug'=>'aws-developer','label'=>'AWS Certified Developer','category'=>'it_cloud','issuing_authority'=>'Amazon','icon'=>'aws','sort_order'=>2],
        ['slug'=>'aws-sysops','label'=>'AWS Certified SysOps Administrator','category'=>'it_cloud','issuing_authority'=>'Amazon','icon'=>'aws','sort_order'=>3],
        ['slug'=>'azure-administrator','label'=>'Microsoft Azure Administrator','category'=>'it_cloud','issuing_authority'=>'Microsoft','icon'=>'azure','sort_order'=>4],
        ['slug'=>'azure-solutions-architect','label'=>'Azure Solutions Architect Expert','category'=>'it_cloud','issuing_authority'=>'Microsoft','icon'=>'azure','sort_order'=>5],
        ['slug'=>'gcp-architect','label'=>'Google Cloud Professional Architect','category'=>'it_cloud','issuing_authority'=>'Google','icon'=>'gcp','sort_order'=>6],
        ['slug'=>'gcp-data-engineer','label'=>'Google Professional Data Engineer','category'=>'it_cloud','issuing_authority'=>'Google','icon'=>'gcp','sort_order'=>7],
        ['slug'=>'rhce','label'=>'Red Hat Certified Engineer (RHCE)','category'=>'it_cloud','issuing_authority'=>'Red Hat','icon'=>'linux','sort_order'=>8],
        ['slug'=>'oracle-ocp','label'=>'Oracle Certified Professional (OCP)','category'=>'it_cloud','issuing_authority'=>'Oracle','icon'=>'oracle','sort_order'=>9],
        ['slug'=>'salesforce-admin','label'=>'Salesforce Administrator','category'=>'it_cloud','issuing_authority'=>'Salesforce','icon'=>'salesforce','sort_order'=>10],

        /* ================= NETWORKING ================= */
        ['slug'=>'ccna','label'=>'Cisco Certified Network Associate (CCNA)','category'=>'networking','issuing_authority'=>'Cisco','icon'=>'network','sort_order'=>11],
        ['slug'=>'ccnp','label'=>'Cisco Certified Network Professional (CCNP)','category'=>'networking','issuing_authority'=>'Cisco','icon'=>'network','sort_order'=>12],
        ['slug'=>'comptia-network','label'=>'CompTIA Network+','category'=>'networking','issuing_authority'=>'CompTIA','icon'=>'network','sort_order'=>13],

        /* ================= CYBERSECURITY ================= */
        ['slug'=>'cissp','label'=>'CISSP','category'=>'cybersecurity','issuing_authority'=>'ISC2','icon'=>'security','sort_order'=>14],
        ['slug'=>'ceh','label'=>'Certified Ethical Hacker (CEH)','category'=>'cybersecurity','issuing_authority'=>'EC-Council','icon'=>'security','sort_order'=>15],
        ['slug'=>'cisa','label'=>'CISA','category'=>'cybersecurity','issuing_authority'=>'ISACA','icon'=>'audit','sort_order'=>16],
        ['slug'=>'cism','label'=>'CISM','category'=>'cybersecurity','issuing_authority'=>'ISACA','icon'=>'security','sort_order'=>17],
        ['slug'=>'security-plus','label'=>'CompTIA Security+','category'=>'cybersecurity','issuing_authority'=>'CompTIA','icon'=>'security','sort_order'=>18],
        ['slug'=>'oscp','label'=>'Offensive Security Certified Professional (OSCP)','category'=>'cybersecurity','issuing_authority'=>'Offensive Security','icon'=>'security','sort_order'=>19],

        /* ================= DEVOPS & CONTAINERS ================= */
        ['slug'=>'cka','label'=>'Certified Kubernetes Administrator (CKA)','category'=>'devops','issuing_authority'=>'CNCF','icon'=>'kubernetes','sort_order'=>20],
        ['slug'=>'ckad','label'=>'Certified Kubernetes Application Developer (CKAD)','category'=>'devops','issuing_authority'=>'CNCF','icon'=>'kubernetes','sort_order'=>21],
        ['slug'=>'docker-certified','label'=>'Docker Certified Associate','category'=>'devops','issuing_authority'=>'Docker','icon'=>'docker','sort_order'=>22],
        ['slug'=>'terraform-associate','label'=>'Terraform Associate','category'=>'devops','issuing_authority'=>'HashiCorp','icon'=>'terraform','sort_order'=>23],

        /* ================= PROJECT MANAGEMENT ================= */
        ['slug'=>'pmp','label'=>'Project Management Professional (PMP)','category'=>'project_management','issuing_authority'=>'PMI','icon'=>'pmp-icon','sort_order'=>24],
        ['slug'=>'capm','label'=>'Certified Associate in Project Management (CAPM)','category'=>'project_management','issuing_authority'=>'PMI','icon'=>'pmp-icon','sort_order'=>25],
        ['slug'=>'scrum-master','label'=>'Certified Scrum Master (CSM)','category'=>'project_management','issuing_authority'=>'Scrum Alliance','icon'=>'agile','sort_order'=>26],
        ['slug'=>'safe-agilist','label'=>'SAFe Agilist','category'=>'project_management','issuing_authority'=>'Scaled Agile','icon'=>'agile','sort_order'=>27],
        ['slug'=>'prince2','label'=>'PRINCE2 Practitioner','category'=>'project_management','issuing_authority'=>'AXELOS','icon'=>'project','sort_order'=>28],

        /* ================= DATA & AI ================= */
        ['slug'=>'data-science','label'=>'Certified Data Scientist','category'=>'data_ai','issuing_authority'=>'Various','icon'=>'data','sort_order'=>29],
        ['slug'=>'machine-learning','label'=>'Machine Learning Certification','category'=>'data_ai','issuing_authority'=>'Various','icon'=>'ai','sort_order'=>30],
        ['slug'=>'power-bi','label'=>'Microsoft Power BI Certification','category'=>'data_ai','issuing_authority'=>'Microsoft','icon'=>'bi','sort_order'=>31],

        /* ================= FINANCE ================= */
        ['slug'=>'ca','label'=>'Chartered Accountant (CA)','category'=>'finance','issuing_authority'=>'ICAI','icon'=>'finance','sort_order'=>32],
        ['slug'=>'cfa','label'=>'Chartered Financial Analyst (CFA)','category'=>'finance','issuing_authority'=>'CFA Institute','icon'=>'finance','sort_order'=>33],
        ['slug'=>'cpa','label'=>'Certified Public Accountant (CPA)','category'=>'finance','issuing_authority'=>'AICPA','icon'=>'finance','sort_order'=>34],
        ['slug'=>'acca','label'=>'ACCA','category'=>'finance','issuing_authority'=>'ACCA','icon'=>'finance','sort_order'=>35],
        ['slug'=>'frm','label'=>'Financial Risk Manager (FRM)','category'=>'finance','issuing_authority'=>'GARP','icon'=>'finance','sort_order'=>36],

        /* ================= QUALITY & ENGINEERING ================= */
        ['slug'=>'six-sigma-green','label'=>'Six Sigma Green Belt','category'=>'quality_engineering','issuing_authority'=>'ASQ','icon'=>'quality','sort_order'=>37],
        ['slug'=>'six-sigma-black','label'=>'Six Sigma Black Belt','category'=>'quality_engineering','issuing_authority'=>'ASQ','icon'=>'quality','sort_order'=>38],
        ['slug'=>'autocad','label'=>'AutoCAD Certification','category'=>'quality_engineering','issuing_authority'=>'Autodesk','icon'=>'engineering','sort_order'=>39],
        ['slug'=>'pmp-engineering','label'=>'Engineering Project Management','category'=>'quality_engineering','issuing_authority'=>'Various','icon'=>'engineering','sort_order'=>40],

        /* ================= HEALTHCARE ================= */
        ['slug'=>'registered-nurse','label'=>'Registered Nurse (RN)','category'=>'healthcare','issuing_authority'=>'State Nursing Council','icon'=>'healthcare','sort_order'=>41],
        ['slug'=>'bls','label'=>'Basic Life Support (BLS)','category'=>'healthcare','issuing_authority'=>'American Heart Association','icon'=>'healthcare','sort_order'=>42],
        ['slug'=>'acls','label'=>'Advanced Cardiovascular Life Support (ACLS)','category'=>'healthcare','issuing_authority'=>'American Heart Association','icon'=>'healthcare','sort_order'=>43],

        ]);
    }
}
