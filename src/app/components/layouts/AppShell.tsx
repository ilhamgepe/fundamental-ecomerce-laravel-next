import { AppShell as MantineAppShell, useMantineTheme } from "@mantine/core";
import { ReactNode, useState } from "react";
import Navbar from "./Navbar";
import Header from "./Header";
const AppShell = ({ children }: { children: ReactNode }) => {
  const theme = useMantineTheme();
  const [opened, setOpened] = useState(false);
  return (
    <MantineAppShell
      padding="md"
      navbar={<Navbar />}
      header={<Header opened={opened} setOpened={setOpened} theme={theme} />}
    >
      {children}
    </MantineAppShell>
  );
};
export default AppShell;