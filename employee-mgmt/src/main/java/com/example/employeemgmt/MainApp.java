package com.example.employeemgmt;

import org.springframework.context.ApplicationContext;
import org.springframework.context.annotation.AnnotationConfigApplicationContext;

public class MainApp {

    public static void main(String[] args) {

        ApplicationContext context =
                new AnnotationConfigApplicationContext(AppConfig.class);

        EmployeeService service = context.getBean(EmployeeService.class);

        service.createEmployee(1, "Alice", 50000);
        service.createEmployee(2, "Bob", 60000);

        System.out.println("Employee List:");
        service.displayEmployees();
    }
}
