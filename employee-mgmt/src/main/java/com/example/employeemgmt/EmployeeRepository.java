package com.example.employeemgmt;

import org.springframework.stereotype.Component;
import java.util.*;

@Component
public class EmployeeRepository {

    private List<Employee> list = new ArrayList<>();

    public void addEmployee(Employee e) {
        list.add(e);
    }

    public List<Employee> getAll() {
        return list;
    }
}
