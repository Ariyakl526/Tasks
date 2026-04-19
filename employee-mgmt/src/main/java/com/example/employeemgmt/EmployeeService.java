package com.example.employeemgmt;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

@Component
public class EmployeeService {

    @Autowired
    private EmployeeRepository repo;

    public void createEmployee(int id, String name, double salary) {
        repo.addEmployee(new Employee(id, name, salary));
    }

    public void displayEmployees() {
        for (Employee e : repo.getAll()) {
            System.out.println(e);
        }
    }
}
